<?php

namespace App\Repositories;


use Exception;
use DOMDocument;
use Carbon\Carbon;
use App\Models\Node;
use App\Models\Block;
use App\Models\Contact;
use App\Models\UrlAlias;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Models\FieldDataBody;
use App\Constants\AppConstants;
use App\Models\PublicPromoMessage;
use App\Models\TaxonomyVocabulary;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\FieldDataFieldCourseTarget;

class HomeRepository
{
    public function contact($contactformdetails): object
    {
        try {

            $recipients = Contact::where('cid', '=', AppConstants::CONTACT_CID)->first();

            if (!$recipients) {
                return response()->json(['message' => 'No recipients found.'], 404);
            }
            $data = [
                'name' => $contactformdetails ->name,
                'email' => $contactformdetails ->email,
                'subject' => $contactformdetails ->subject,
                'message' => $contactformdetails ->message,
            ];

            Mail::to($recipients->recipients)->send(new ContactFormMail($data));


            return $recipients;

        } catch (\Exception $e) {

            Log::error('Error in fetching events', [
                'function' => 'contact',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return (object) [];
        }
    }
    public function index($listevents): object
    {
        try {

            $events = Node::join('field_data_field_event_type', 'field_data_field_event_type.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_event_date', 'field_data_field_event_date.entity_id', '=', 'node.nid')
                ->where('field_data_field_event_type.field_event_type_value', '=', AppConstants::FIELD_EVENT_TYPE_VALUE)
                ->whereDate('field_data_field_event_date.field_event_date_value', '>=', Carbon::today())
                ->select('node.title', 'field_data_field_event_date.field_event_date_value', 'node.nid')
                ->orderBy('field_data_field_event_date.field_event_date_value', 'asc')
                ->take(3)
                ->get()
                ->map(function ($event) {

                    $urlAlias = UrlAlias::where('source', '=', 'node/' . $event->nid)
                        ->select('alias')
                        ->first();
                    $event->url = !empty($urlAlias) ? $urlAlias->alias : '';

                    return $event;
                });

            return $events;


        } catch (\Exception $e) {
            Log::error('Error in fetching events', [
                'function' => 'homeServiceIndex',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return (object) [];
        }
    }
    public function showevents($request, $events_slug): object
    {
        try {

            $currentUrl = url()->current();
            $decodedUrl = urldecode($currentUrl);
            $baseUrl = url()->to('/');
            $relativeUrl = Str::after($decodedUrl, $baseUrl);
            $segment = AppConstants::COURSES . '/';
            $relativeUrlAfterSegment = Str::after($relativeUrl, $segment);
            $urlAlias = UrlAlias::where('alias', $relativeUrlAfterSegment)->first();
            preg_match('/node\/(\d+)$/', $urlAlias->source, $matches);
            $nodeId = $matches[1];


            $eventlist = Node::leftJoin('field_data_body', 'field_data_body.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_event_type', 'field_data_field_event_type.entity_id', '=', 'node.nid')
                ->where('node.type', AppConstants::NODETYPE_EVENTS)
                ->where('field_data_field_event_type.field_event_type_value', AppConstants::FIELD_EVENT_TYPE_VALUE)
                ->where('node.status', AppConstants::NODE_STATUS)
                ->where('node.nid', $nodeId)
                ->first();

            if ($eventlist && $eventlist->body_value) {
                $eventlist->body_value = str_replace(AppConstants::SHOW_EVENT_REGIS_BUTTON, 'REGISTER HERE', $eventlist->body_value);
            }

            return (object) $eventlist;

        } catch (\Exception $e) {
            Log::error('Error in fetching allevents', [
                'function' => 'showevents',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }

    public function showCaseStudies()
    {
        try {
            $casestudies = Node::where('node.type', '=', AppConstants::NODETYPE_DEXP_PORTFOLIO)
                ->select('node.title', 'node.nid')
                ->get()
                ->map(function ($case) {
                    $urlAlias = UrlAlias::where('source', '=', 'node/' . $case->nid)
                        ->select('alias')
                        ->first();

                    $case->url_alias = $urlAlias ? $urlAlias->alias : null;

                    return $case;
                });
            if ($casestudies) {
                return $casestudies;
            } else {
                return [];
            }
        } catch (\Exception $e) {
            Log::error('Error in showCaseStudies', [
                'function' => 'showCaseStudies',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return [];
        }
    }

    public function showCaseStudy(int $id): object
    {
        try {
            $case = FieldDataBody::where('entity_id', '=', $id)
                ->select('body_value')
                ->get();
            return $case;
        } catch (\Exception $e) {
            Log::error('Error in showCaseStudy', [
                'function' => 'showCaseStudy',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return (object) [];
        }
    }
    public function showWhoWeAre($request)
    {
        return $this->getContentByAlias(AppConstants::WHO_WE_ARE_ALIAS);

    }

    public function showmanagementTeam($request)
    {
        return $this->getContentByAlias(AppConstants::MANAGEMENT_TEAM_ALIAS);

    }
    public function showPartners($request)
    {
        return $this->getContentByAlias(AppConstants::PARTNERS_ALIAS);

    }
    public function showEarning($request)
    {
        return $this->getContentByAlias(AppConstants::EARNING_CREDITS_ALIAS);

    }
    public function showExamPass($request)
    {
        return $this->getContentByAlias(AppConstants::EXAM_PASS_GUARANTEES_ALIAS);

    }
    public function showprivacypolicy($request)
    {
        return $this->getContentByAlias(AppConstants::PROCEPT_PRIVACY_POLICY_ALIAS);
    }
    public function showCourseType($request)
    {
        $coursetype = TaxonomyVocabulary::join('taxonomy_term_data', 'taxonomy_vocabulary.vid', '=', 'taxonomy_term_data.vid')
            ->where('taxonomy_vocabulary.machine_name', AppConstants::TAXONOMY_VOCABULARY_COURSE_TYPE)
            ->where('taxonomy_term_data.name', AppConstants::TAXONOMY_COURSE_TYPE_CM_COURSE)
            ->select(
                'taxonomy_vocabulary.vid',
                'taxonomy_term_data.name',
                'taxonomy_term_data.tid'
            )
            ->get();

        if ($coursetype) {
            return $coursetype;
        } else {
            return [];
        }

    }

    public function getContentByAlias($alias)
    {
        try {
            $source = UrlAlias::select('source')
                ->where('url_alias.alias', '=', $alias)
                ->first();

            if ($source && preg_match('/\d+/', $source->source, $matches)) {
                $value = $matches[0];

                $aboutus = Node::leftJoin('field_data_body', 'field_data_body.entity_id', '=', 'node.nid')
                    ->where('node.nid', '=', $value)
                    ->select('node.title', 'field_data_body.body_value')
                    ->first();

                if ($aboutus) {
                    // Perform HTML content modification
                    $aboutus->body_value = str_replace(AppConstants::PRIVACY_POLICY_MAIL, AppConstants::PRIVACY_POLICY_SENDMAIL, $aboutus->body_value);

                    return $aboutus;
                } else {
                    throw new Exception('No content found');
                }
            } else {
                throw new Exception('No numeric value found');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function getallevents($request): object
    {
        try {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $todayDate = now()->startOfDay();

            $filterevent = Node::join('field_data_field_event_type', 'field_data_field_event_type.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_event_date', 'field_data_field_event_date.entity_id', '=', 'node.nid')
                ->where('field_data_field_event_type.field_event_type_value', '=', AppConstants::FIELD_EVENT_TYPE_VALUE)
                ->where('node.status', AppConstants::NODE_STATUS)->whereDate('field_data_field_event_date.field_event_date_value', '>=', $todayDate);


            if ($startDate && $endDate) {
                $filterevent->whereBetween('field_data_field_event_date.field_event_date_value', [$startDate, $endDate]);
            }

            $listallevents = $filterevent->select('node.title', 'field_data_field_event_date.field_event_date_value', 'node.nid')
            ->orderBy('field_data_field_event_date.field_event_date_value', 'asc')
            ->get()
            ->map(function ($event) {
                $event->formatted_date = Carbon::parse($event->field_event_date_value)->format('l, F j, Y - H:i');
                $urlAlias = UrlAlias::where('source', 'node/' . $event->nid)->first();
                $event->url = $urlAlias ? $urlAlias->alias : '';

                return $event;
            });

            return $listallevents;


        } catch (\Exception $e) {
            Log::error('Error in fetching event list', [
                'function' => 'getallevents',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }

    }
    public function getAllCompanyNews($request): object
    {

        try {
            $allCompanyNews = Node::with('fieldDataBody')
                ->leftJoin('field_data_field_media', function ($join) {
                    $join->on('field_data_field_media.entity_id', '=', 'node.nid')
                        ->where('field_data_field_media.delta', '=', 0);
                })
                ->leftJoin('file_managed', 'file_managed.fid', '=', 'field_data_field_media.field_media_fid')
                ->where('node.type', AppConstants::NODETYPE_ARTICLE)
                ->where('node.promote', AppConstants::NODE_PROMOTE)
                ->where('node.status', AppConstants::NODE_STATUS)
                ->orderBy('node.nid', 'desc')
                ->paginate(10);

            $allCompanyNews->getCollection()->transform(function ($item) {
                $urlAlias = UrlAlias::where('source', 'node/' . $item->nid)->first();
                $item->url = $urlAlias ? $urlAlias->alias : '';
                $pageTitle = explode(':', $item->title);
                $item->titleOne = $pageTitle[1] ?? '';
                $item->titleTwo = $pageTitle[0] ?? '';
                return $item;
            });
            return (object) $allCompanyNews;

        } catch (\Exception $e) {

            Log::error('Error in fetching company news', [
                'function' => 'getAllCompanyNews',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }
    public function showPromotionalMessageBar($request): object
    {
        try {
            $promoMessageDetails = PublicPromoMessage::get();
            return (object) $promoMessageDetails;
        } catch (Exception $e) {

            Log::error('Error in fetching Promotional Message Bar list', [
                'function' => 'showPromotionalMessageBar',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }
    public function showUpcomingCourse($request): object
    {
        try {
            $todayDate = date('Y-m-d 00:00:00');

            $upcomingCoursesNodeData = Node::with('fieldDataFieldCourseNodeDetails.fieldDataFieldCourseNode', 'fieldDataFieldResaleNode.fieldDataFieldProceptSellTicketCourse.fieldDataFieldIfYesEventbriteLinkResale')->join('field_data_field_choose_session_type', 'field_data_field_choose_session_type.entity_id', '=', 'node.nid')
                ->join('field_data_field_public_', 'field_data_field_public_.entity_id', 'node.nid')
                ->leftJoin('field_data_field_session_dates', 'field_data_field_session_dates.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date1', 'field_data_field_start_date1.entity_id', '=', 'node.nid')
                ->where('node.type', AppConstants::NODETYPE_SESSION)
                ->where('node.status', AppConstants::NODE_STATUS)
                ->where('field_data_field_public_.field_public__value', AppConstants::FIELD_PUBLIC_VALUE)
                ->where(function ($query) {
                    $query->where('field_data_field_choose_session_type.field_choose_session_type_value', AppConstants::SESSION_TYPE_CONTIGUOUS)
                        ->orWhere('field_data_field_choose_session_type.field_choose_session_type_value', AppConStants::SESSION_TYPE_BROKEN_UP);
                })
                ->where(function ($query) use ($todayDate) {
                    $query->where('field_data_field_session_dates.field_session_dates_value', '>=', $todayDate)
                        ->orWhere('field_data_field_start_date1.field_start_date1_value', '>=', $todayDate);
                })
                ->orderBy('field_data_field_session_dates.field_session_dates_value', 'asc')
                ->orderBy('field_data_field_start_date1.field_start_date1_value', 'asc')
                ->take(5)
                ->get();

            return (object) $upcomingCoursesNodeData;

        } catch (Exception $e) {

            Log::error('Error in fetching upcoming public courses on the home page', [
                'function' => 'showUpcomingCourse',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }

    }

    public function showUpcomingPublicCourse($request): object
    {
        try {

            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $todayDate = now()->startOfDay();

            $filtercourse = Node::with([
                'fieldDataFieldCourseNodeDetails.fieldDataFieldCourseNode',
                'fieldDataFieldResaleNode.fieldDataFieldProceptSellTicketCourse.fieldDataFieldIfYesEventbriteLinkResale',
                'fieldDataFieldCourseInstructor.fieldCourseInstructorNode',
                'fieldDataFieldInstructor1.fieldDataFieldInstructorNode1',
                'fieldDataFieldInstructor2.fieldDataFieldInstructorNode2',
                'fieldDataFieldInstructor3.fieldDataFieldInstructorNode3',
                'fieldDataFieldInstructor4.fieldDataFieldInstructorNode4',
                'fieldDataFieldInstructor5.fieldDataFieldInstructorNode5',
                'fieldDataFieldInstructor6.fieldDataFieldInstructorNode6',
                'fieldDataFieldInstructor7.fieldDataFieldInstructorNode7',
                'fieldDataFieldInstructor8.fieldDataFieldInstructorNode8',
                'fieldDataFieldInstructor9.fieldDataFieldInstructorNode9',
                'fieldDataFieldInstructor10.fieldDataFieldInstructorNode10'
            ])
                ->join('field_data_field_choose_session_type', 'field_data_field_choose_session_type.entity_id', '=', 'node.nid')
                ->join('field_data_field_public_', 'field_data_field_public_.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_session_dates', 'field_data_field_session_dates.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date1', 'field_data_field_start_date1.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date2', 'field_data_field_start_date2.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date3', 'field_data_field_start_date3.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date4', 'field_data_field_start_date4.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date5', 'field_data_field_start_date5.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date6', 'field_data_field_start_date6.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date7', 'field_data_field_start_date7.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date8', 'field_data_field_start_date8.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date9', 'field_data_field_start_date9.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_start_date10', 'field_data_field_start_date10.entity_id', '=', 'node.nid')
                ->where('node.type', AppConstants::NODETYPE_SESSION)
                ->where('node.status', AppConstants::NODE_STATUS)
                ->where('field_data_field_public_.field_public__value', AppConstants::FIELD_PUBLIC_VALUE);

            // Filter by upcoming dates from start date to end date
            if ($startDate && $endDate) {
                $filtercourse->where(function ($filtercourse) use ($startDate, $endDate) {
                    $filtercourse->whereBetween('field_data_field_session_dates.field_session_dates_value', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_session_dates.field_session_dates_value2', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_start_date1.field_start_date1_value', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_start_date2.field_start_date2_value', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_start_date3.field_start_date3_value', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_start_date4.field_start_date4_value', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_start_date5.field_start_date5_value', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_start_date6.field_start_date6_value', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_start_date7.field_start_date7_value', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_start_date8.field_start_date8_value', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_start_date9.field_start_date9_value', [$startDate, $endDate])
                        ->orWhereBetween('field_data_field_start_date10.field_start_date10_value', [$startDate, $endDate]);
                });
            }

            // Filter by upcoming dates from today
            $filtercourse->where(function ($filtercourse) use ($todayDate) {
                $filtercourse->where('field_data_field_session_dates.field_session_dates_value', '>=', $todayDate)
                    ->orWhere('field_data_field_session_dates.field_session_dates_value2', '>=', $todayDate)
                    ->orWhere('field_data_field_start_date1.field_start_date1_value', '>=', $todayDate)
                    ->orWhere('field_data_field_start_date2.field_start_date2_value', '>=', $todayDate)
                    ->orWhere('field_data_field_start_date3.field_start_date3_value', '>=', $todayDate)
                    ->orWhere('field_data_field_start_date4.field_start_date4_value', '>=', $todayDate)
                    ->orWhere('field_data_field_start_date5.field_start_date5_value', '>=', $todayDate)
                    ->orWhere('field_data_field_start_date6.field_start_date6_value', '>=', $todayDate)
                    ->orWhere('field_data_field_start_date7.field_start_date7_value', '>=', $todayDate)
                    ->orWhere('field_data_field_start_date8.field_start_date8_value', '>=', $todayDate)
                    ->orWhere('field_data_field_start_date9.field_start_date9_value', '>=', $todayDate)
                    ->orWhere('field_data_field_start_date10.field_start_date10_value', '>=', $todayDate);
            });

            $filtercourse->whereIn('field_data_field_choose_session_type.field_choose_session_type_value', [
                AppConstants::SESSION_TYPE_CONTIGUOUS,
                AppConstants::SESSION_TYPE_BROKEN_UP
            ])
                ->orderBy('field_data_field_session_dates.field_session_dates_value')
                ->orderBy('field_data_field_start_date1.field_start_date1_value')
                ->orderBy('field_data_field_start_date2.field_start_date2_value')
                ->orderBy('field_data_field_start_date3.field_start_date3_value')
                ->orderBy('field_data_field_start_date4.field_start_date4_value')
                ->orderBy('field_data_field_start_date5.field_start_date5_value')
                ->orderBy('field_data_field_start_date6.field_start_date6_value')
                ->orderBy('field_data_field_start_date7.field_start_date7_value')
                ->orderBy('field_data_field_start_date8.field_start_date8_value')
                ->orderBy('field_data_field_start_date9.field_start_date9_value')
                ->orderBy('field_data_field_start_date10.field_start_date10_value');

            // Pagination
            $upcomingPublicCourse = $filtercourse->paginate(10);

            // Process and return results
            $this->getUpcomingPublicCourseUrl($upcomingPublicCourse);

            return $upcomingPublicCourse;

        } catch (Exception $e) {

            Log::error('Error in fetching upcoming public courses on the List', [
                'function' => 'showUpcomingPublicCourse',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }

    }

    public function getUpcomingPublicCourseUrl($upcomingPublicCourse)
    {
        $upcomingPublicCourse->each(function ($course) {
            // Course URL
            $course->course_url = $this->getUrlAlias('node/' . $course->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->nid);

            if (!empty($course->fieldDataFieldCourseInstructor) && isset($course->fieldDataFieldCourseInstructor->fieldCourseInstructorNode->nid)) {
                $course->fieldCourseInstructor_url = $this->getUrlAlias('node/' . $course->fieldDataFieldCourseInstructor->fieldCourseInstructorNode->nid);
            }

            // Instructor 1 URL
            if ($course->fieldDataFieldInstructor1) {
                $instructor1 = $course->fieldDataFieldInstructor1->fieldDataFieldInstructorNode1;
                if ($instructor1) {
                    $course->instructor1_url = $this->getUrlAlias('node/' . $instructor1->nid);
                }
            }
            // Instructor 2 URL
            if ($course->fieldDataFieldInstructor2) {
                $instructor2 = $course->fieldDataFieldInstructor2->fieldDataFieldInstructorNode2;
                if ($instructor2) {
                    $course->instructor2_url = $this->getUrlAlias('node/' . $instructor2->nid);
                }
            }
            // Instructor 3 URL
            if ($course->fieldDataFieldInstructor3) {
                $instructor3 = $course->fieldDataFieldInstructor3->fieldDataFieldInstructorNode3;
                if ($instructor3) {
                    $course->instructor3_url = $this->getUrlAlias('node/' . $instructor3->nid);
                }
            }
            // Instructor 4 URL
            if ($course->fieldDataFieldInstructor4) {
                $instructor4 = $course->fieldDataFieldInstructor4->fieldDataFieldInstructorNode4;
                if ($instructor4) {
                    $course->instructor4_url = $this->getUrlAlias('node/' . $instructor4->nid);
                }
            }
            // Instructor 5 URL
            if ($course->fieldDataFieldInstructor5) {
                $instructor5 = $course->fieldDataFieldInstructor5->fieldDataFieldInstructorNode5;
                if ($instructor5) {
                    $course->instructor5_url = $this->getUrlAlias('node/' . $instructor5->nid);
                }
            }
            // Instructor 6 URL
            if ($course->fieldDataFieldInstructor6) {
                $instructor6 = $course->fieldDataFieldInstructor6->fieldDataFieldInstructorNode6;
                if ($instructor6) {
                    $course->instructor6_url = $this->getUrlAlias('node/' . $instructor6->nid);
                }
            }
            // Instructor 7 URL
            if ($course->fieldDataFieldInstructor7) {
                $instructor7 = $course->fieldDataFieldInstructor7->fieldDataFieldInstructorNode7;
                if ($instructor7) {
                    $course->instructor7_url = $this->getUrlAlias('node/' . $instructor7->nid);
                }
            }
            // Instructor 8 URL
            if ($course->fieldDataFieldInstructor8) {
                $instructor8 = $course->fieldDataFieldInstructor8->fieldDataFieldInstructorNode8;
                if ($instructor8) {
                    $course->instructor8_url = $this->getUrlAlias('node/' . $instructor8->nid);
                }
            }

            // Instructor 9 URL
            if ($course->fieldDataFieldInstructor9) {
                $instructor9 = $course->fieldDataFieldInstructor9->fieldDataFieldInstructorNode9;
                if ($instructor9) {
                    $course->instructor9_url = $this->getUrlAlias('node/' . $instructor9->nid);
                }
            }

            // Instructor 10 URL
            if ($course->fieldDataFieldInstructor10) {
                $instructor10 = $course->fieldDataFieldInstructor10->fieldDataFieldInstructorNode10;
                if ($instructor10) {
                    $course->instructor10_url = $this->getUrlAlias('node/' . $instructor10->nid);
                }
            }
            //location URL

            if ($course->FieldDataFieldSessionLocLocation->fieldDataFieldOnline->field_online_value == AppConstants::LOCATION_INPERON) {
                $locationDetails = $course->FieldDataFieldSessionLocLocation->fieldDataFieldSessionLocation->FieldDataFieldSessionLocationNode;
                if ($locationDetails) {
                    $course->locationDetails_url = $this->getUrlAlias('node/' . $locationDetails->nid);
                }
            }

        });
    }

    private function getUrlAlias($source)
    {
        static $urlAliases = [];

        if (!isset($urlAliases[$source])) {
            $urlAlias = UrlAlias::where('source', $source)->first();
            $urlAliases[$source] = $urlAlias ? $urlAlias->alias : '';
        }

        return $urlAliases[$source];
    }


    public function showfiltercourse($request): object
    {
        try {
            $search = $request->input('title');

            $filtercourse = Node::join('field_data_field_active_course', 'field_data_field_active_course.entity_id', '=', 'node.nid')
                ->where('node.type', '=', AppConstants::NODETYPE_COURSE)
                ->where('node.status', '=', AppConstants::NODE_STATUS)
                ->where('field_data_field_active_course.field_active_course_value', '=', AppConstants::FIELD_ACTIVE_COURSE_VALUE)
                ->where('node.title', 'LIKE', '%' . $search . '%')
                ->select('node.title', 'node.nid')
                ->get()
                ->take(3)
                ->map(function ($courseurl) {
                    $urlAlias = UrlAlias::where('source', '=', 'node/' . $courseurl->nid)
                        ->select('alias')
                        ->first();
                    $courseurl->url = !empty($urlAlias) ? $urlAlias->alias : '';
                    return $courseurl;
                });


            return (object) $filtercourse;

        } catch (\Exception $e) {

            Log::error('Error in fetching course title', [
                'function' => 'showfiltercourse',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }
    public function showfilterdescription($id)
    {
        try {
            $filterdescription = Node::leftJoin('field_data_field_abstract', 'field_data_field_abstract.entity_id', '=', 'node.nid')
                ->where('node.nid', $id)
                ->select('node.nid', 'node.title', 'field_data_field_abstract.field_abstract_value')
                ->first();
            return $filterdescription;

        } catch (\Exception $e) {
            Log::error('Error in fetching course description', [
                'function' => 'showfilterdescription',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return [];
        }
    }

    public function showTestimonials($request): object
    {
        try {
            $getTestimonials = Node::with('fieldDataBody', 'fieldDataFieldHomepageTestimonialImage.fileManagedHomepageTestimonialImage', 'fieldDataFieldSpeaker')
                ->where('node.type', AppConstants::NODETYPE_HOME_PAGE_TESTIMONIAL)
                ->where('node.status', '=', AppConstants::NODE_STATUS)
                ->get();

            return (object) $getTestimonials;
        } catch (Exception $e) {
            Log::error('Error in fetching Testimonials', [
                'function' => 'showTestimonials',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return (object) [];
        }
    }


    public function showMenubar($request): object
    {


        try {

            $coursetitle = TaxonomyVocabulary::join('taxonomy_term_data', 'taxonomy_vocabulary.vid', '=', 'taxonomy_term_data.vid')
            ->where('taxonomy_vocabulary.machine_name', AppConstants::TAXONOMY_VOCABULARY_COURSE_TYPE)
            ->orderBy('taxonomy_term_data.tid', 'asc')
            ->get()
            ->filter(function ($course) {
                return $course->name !== AppConstants::GENERAL_COURSES;
            })
            ->map(function ($course) {
                $urlAlias = UrlAlias::where('source', AppConstants::TAXONOMY_TERM_COURSE . $course->tid)->first();
                if ($urlAlias) {
                    $course->url = str_replace(AppConstants::MENU_BAR_COURSE_TYPE, '', $urlAlias->alias);
                } else {
                    $course->url = '';
                }
                return $course;
            });

            $courseSubmenus = $coursetitle->map(function ($course) {
                return [
                    'title' => $course->name,
                    'url' => $course->url,
                ];
            })->toArray();

            $trainingMenuBarDetails = [
                [
                    'title' => AppConstants::MENU_TRAINING,
                    'submenus' => [
                        [
                            'title' => AppConstants::SUBMENU_COURSE_CATALOGUE,
                            'submenus' => $courseSubmenus,
                        ],
                        ['title' => AppConstants::SUBMENU_UPCOMING_PUBLIC_COURSES, 'url' => AppConstants::ALL_UPCOMING_COURSES],
                        ['title' => AppConstants::SUBMENU_CUSTOM_COURSES],
                        ['title' => AppConstants::SUBMENU_NEEDS_ASSESSMENTS],
                        ['title' => AppConstants::SUBMENU_EXPERIENCE],
                        ['title' => AppConstants::SUBMENU_EARNING_CREDITS, 'url' => AppConstants::EARN_CREDITS_URL],
                        ['title' => AppConstants::SUBMENU_EXAM_PASS_GUARANTEE, 'url' => AppConstants::EXAM_PASS_GUARANTEE_URL],
                    ],
                ],
            ];

            $menuBarDetails = [
            [
                'title' => AppConstants::MENU_CONSULTING,
                'submenus' => [
                    ['title' => AppConstants::SUBMENU_EXPERIENCE],
                    ['title' => AppConstants::SUBMENU_SERVICE_OFFERINGS],
                    ['title' => AppConstants::SUBMENU_CASE_STUDIES],
                ],
            ],
            [
                'title' => AppConstants::MENU_ABOUT,
                'submenus' => [
                    ['title' => AppConstants::SUBMENU_WHO_WE_ARE, 'url' => AppConstants::WHO_WE_ARE_URL],
                    ['title' => AppConstants::SUBMENU_COMPANY_HISTORY, 'url' => AppConstants::HISTORY_URL],
                    ['title' => AppConstants::SUBMENU_INDUSTRY_RECOGNITION],
                    ['title' => AppConstants::SUBMENU_MANAGEMENT_TEAM, 'url' => AppConstants::MANAGEMENT_TEAM_URL],
                    ['title' => AppConstants::SUBMENU_TRAINERS_CONSULTANTS, 'url' => AppConstants::CONSULTANTS_URL],
                    ['title' => AppConstants::SUBMENU_PARTNERS, 'url' => AppConstants::PARTNERS_URL],
                    [
                        'title' => AppConstants::MEGAMENU_POLICIES,
                        'submenus' => [
                            ['title' => AppConstants::MEGAMENU_ACCESSIBILITY_POLICIES, 'url' => AppConstants::ACCESSIBILITY_POLICY_URL],
                            ['title' => AppConstants::MEGAMENU_DIVERSITY_POLICIES, 'url' => AppConstants::DIVERSITY_POLICY_URL],
                            ['title' => AppConstants::MEGAMENU_DRUG_AND_ALCOHOL_POLICIES, 'url' => AppConstants::DRUG_AND_ALCOHOL_POLICY_URL],
                            ['title' => AppConstants::MEGAMENU_ENVIRONMENTAL_POLICY, 'url' => AppConstants::ENVIRONMENTAL_POLICY_URL],
                            ['title' => AppConstants::MEGAMENU_HEALTH_AND_SAFETY_POLICY, 'url' => AppConstants::HEALTH_AND_SAFETY_POLICY_URL],
                            ['title' => AppConstants::MEGAMENU_RECORDING_POLICY, 'url' => AppConstants::POLICY_RECORDING_TRAINING_SESSIONS_URL],
                        ],
                    ],
                ],
            ],
            ];

            return (object)[
                'menuBarDetails' => $menuBarDetails,
                'trainingMenuBarDetails' => $trainingMenuBarDetails
            ];

        } catch (Exception $e) {
            Log::error('Error in fetching Menu Bar', [
                'function' => 'showMenubar',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }

    public function industryRecoginationLogoslider($request): object
    {
        try {
            $Logoslider = [
                AppConstants::IIBALOGO_IMG,
                AppConstants::GOLD_SEAL_ACCREDITATION_LOGO_IMG,
                AppConstants::PMI_ATP_SEAL_FC_RGB_IMG
            ];
            return (object) $Logoslider;
        } catch (Exception $e) {
            Log::error('Error in fetching industry recogination logo slider', [
                'function' => 'industryRecoginationLogoslider',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }

    }
    public function contactInformationBlock($request): object
    {
        try {
            $contactInformation = Block::join('block_custom', 'block_custom.bid', '=', 'block.delta')
                ->where('pages', AppConstants::CONTACT)
                ->where('visibility', AppConstants::VISIBILITY)
                ->where('theme', AppConstants::EXCEPTION)
                ->get();

            if ($contactInformation) {

                $replacements = [
                    AppConstants::CONTACT_PAGE_MAIL_ONE => AppConstants::CONTACT_PAGE_SENDMAIL_ONE,
                    AppConstants::CONTACT_PAGE_MAIL_TWO => AppConstants::CONTACT_PAGE_SENDMAIL_TWO,
                    AppConstants::CONTACT_PAGE_MAIL_THREE => AppConstants::CONTACT_PAGE_SENDMAIL_THREE,
                    AppConstants::CONTACT_PAGE_MAIL_FOUR => AppConstants::CONTACT_PAGE_SENDMAIL_FOUR,
                    AppConstants::CONTACT_PAGE_MAIL_FIVE => AppConstants::CONTACT_PAGE_SENDMAIL_FIVE,
                    AppConstants::CONTACT_PAGE_MAIL_SIX => AppConstants::CONTACT_PAGE_SENDMAIL_SIX,
                    AppConstants::CONTACT_PAGE_MAIL_SEVEN => AppConstants::CONTACT_PAGE_SENDMAIL_SEVEN,
                ];

                foreach ($contactInformation as $contact) {
                    foreach ($replacements as $search => $replace) {
                        $contact->body = str_replace($search, $replace, $contact->body);
                    }
                }
            }


            return $contactInformation;
        } catch (Exception $e) {
            Log::error('Error in fetching contact information block', [
                'function' => 'contactInformationBlock',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }
    public function getRssFeed($request): object
    {
        try {
            $allRssFeed = Node::with('fieldDataBody')
                ->leftJoin('field_data_field_media', function ($join) {
                    $join->on('field_data_field_media.entity_id', '=', 'node.nid')
                        ->where('field_data_field_media.delta', '=', 0);
                })
                ->leftJoin('file_managed', 'file_managed.fid', '=', 'field_data_field_media.field_media_fid')
                ->where('node.type', AppConstants::NODETYPE_ARTICLE)
                ->where('node.promote', AppConstants::NODE_PROMOTE)
                ->where('node.status', AppConstants::NODE_STATUS)
                ->orderBy('node.nid', 'desc')

                ->get()
                ->take(10)
                ->map(function ($item) {
                    $urlAlias = UrlAlias::where('source', 'node/' . $item->nid)->first();
                    $item->url = $urlAlias ? $urlAlias->alias : '';
                    $pageTitle = explode(':', $item->title);
                    $item->titleOne = $pageTitle[1] ?? '';
                    $item->titleTwo = $pageTitle[0] ?? '';
                    return $item;
                });

            return (object) $allRssFeed;

        } catch (\Exception $e) {

            Log::error('Error in fetching company news in rss feed', [
                'function' => 'getRssFeed',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }

    public function getAllUpcomingCourses($request, $course_slug): object
    {

        try {

            $todayDate = now()->startOfDay();
            $currentUrl = url()->current();
            $decodedUrl = urldecode($currentUrl);
            $baseUrl = url()->to('/');
            $relativeUrl = Str::after($decodedUrl, $baseUrl);
            $segment = AppConstants::COURSES . '/';
            $relativeUrlAfterSegment = Str::after($relativeUrl, $segment);
            $urlAlias = UrlAlias::where('alias', $relativeUrlAfterSegment)->first();
            preg_match('/node\/(\d+)$/', $urlAlias->source, $matches);
            $nodeId = $matches[1];

            //Courses Content
            $getAllUpcomingCourses = Node::with('fieldDataFieldCourseId', 'fieldDataFieldDuration')
                     ->LeftJoin('field_data_field_course_level', 'field_data_field_course_level.entity_id', 'node.nid')
                     ->LeftJoin('taxonomy_term_data', 'taxonomy_term_data.tid', 'field_data_field_course_level.field_course_level_tid')
                     ->LeftJoin('field_data_field_abstract', 'field_data_field_abstract.entity_id', '=', 'node.nid')
                     ->LeftJoin('field_data_field_brochure_link', 'field_data_field_brochure_link.entity_id', 'node.nid')
                     ->LeftJoin('field_data_field_pdu', 'field_data_field_pdu.entity_id', 'node.nid')
                     ->where('node.nid', $nodeId)
                     ->where('node.status', AppConstants::NODE_STATUS)
                     ->first();

            //Courses testinomials
            $getTestinomials = FieldDataFieldCourseTarget::with('FieldDataBodyCourse', 'FieldDataFieldTestimonialPositionNode', 'FieldDataFieldTestimonialImage.FileManagedTestimonialImage')
                  ->join('node', 'node.nid', 'field_data_field_course_target.field_course_target_target_id')
                  ->where('field_course_target_target_id', $nodeId)
                  ->where('node.status', AppConstants::NODE_STATUS)
                  ->get();

            //Courses upcoming session
            $getUpcomingSession = Node::with('fieldDataFieldCourseInstructor.fieldCourseInstructorNode', 'fieldDataFieldInstructor1.fieldDataFieldInstructorNode1')
                  ->join('field_data_field_course', 'field_data_field_course.entity_id', '=', 'node.nid')
                  ->join('field_data_field_choose_session_type', 'field_data_field_choose_session_type.entity_id', '=', 'node.nid')
                  ->leftJoin('field_data_field_session_dates', 'field_data_field_session_dates.entity_id', '=', 'node.nid')
                  ->leftJoin('field_data_field_start_date1', 'field_data_field_start_date1.entity_id', '=', 'node.nid')
                  ->join('field_data_field_resale', 'field_data_field_resale.entity_id', 'node.nid')
                  ->join('field_data_field_procept_sell_ticket_course', 'field_data_field_procept_sell_ticket_course.entity_id', 'field_data_field_resale.field_resale_value')
                  ->join('field_data_field_if_yes_eventbrite_link', 'field_data_field_if_yes_eventbrite_link.entity_id', 'field_data_field_resale.field_resale_value')
                  ->join('field_data_field_session_loc_location', 'field_data_field_session_loc_location.entity_id', 'node.nid')
                  ->join('field_data_field_online', 'field_data_field_online.entity_id', 'field_data_field_session_loc_location.field_session_loc_location_value')
                  ->where(function ($query) {
                      $query->where('field_data_field_choose_session_type.field_choose_session_type_value', AppConstants::SESSION_TYPE_CONTIGUOUS)
                        ->orWhere('field_data_field_choose_session_type.field_choose_session_type_value', AppConstants::SESSION_TYPE_BROKEN_UP);
                  })
                  ->where(function ($query) use ($todayDate) {
                      $query->where('field_data_field_session_dates.field_session_dates_value', '>=', $todayDate)
                         ->orWhere('field_data_field_start_date1.field_start_date1_value', '>=', $todayDate);
                  })
                  ->where('node.status', AppConstants::NODE_STATUS)
                  ->where('field_data_field_course.field_course_target_id', $nodeId)
                  ->where('field_data_field_procept_sell_ticket_course.field_procept_sell_ticket_course_value', AppConstants::FIELD_RESALES_YES)
                  ->orderBy('field_data_field_session_dates.field_session_dates_value', 'asc')
                  ->orderBy('field_data_field_start_date1.field_start_date1_value', 'asc')
                  ->take(3)
                  ->get();

            //courses video testinomials
            $getVideoTestinomials = Block::join('block_custom', 'block_custom.bid', '=', 'block.delta')
                 ->where('pages', 'node/'.$nodeId)
                 ->where('visibility', AppConstants::VISIBILITY)
                 ->where('status', AppConstants::NODE_STATUS)
                 ->where('theme', AppConstants::EXCEPTION)->first();

if ($getVideoTestinomials && !empty($getVideoTestinomials->body)) {

                $dom = new DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML($getVideoTestinomials->body);
                libxml_clear_errors();
                $iframes = $dom->getElementsByTagName('iframe');
                $iframeSrcs = [];

                foreach ($iframes as $iframe) {

                    $src = $iframe->getAttribute('src');
                    $iframeSrcs[] = $src;
                }

            } else {
                $iframeSrcs = [];
            }

            return (object) [
              'course' => $getAllUpcomingCourses,
              'testimonials' => $getTestinomials,
              'upcomingSession' => $getUpcomingSession,
              'getVideoTestinomials' => $getVideoTestinomials,
              'videolinkiframe' => $iframeSrcs,
            ];
        } catch (\Exception $e) {

            Log::error('Error in fetching all upcoming courses', [
                'function' => 'getAllUpcomingCourses',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }

    public function getAllUpcomingCoursesSessions($request, $course_title_slug): object
    {
        try {

            $todayDate = now()->startOfDay();
            $currentUrl = url()->current();
            $decodedUrl = urldecode($currentUrl);
            $baseUrl = url()->to('/');
            $relativeUrl = Str::after($decodedUrl, $baseUrl);
            $segment = AppConstants::UPCOMING_SESSIONS . '/';
            $relativeUrlAfterSegment = Str::after($relativeUrl, $segment);
            $urlAlias = UrlAlias::where('alias', $relativeUrlAfterSegment)->first();
            preg_match('/node\/(\d+)$/', $urlAlias->source, $matches);

            $nodeId = $matches[1];

            $getCourseTitle = Node::where('node.nid', $nodeId)->first();

            $getAllUpcomingCoursesSessions = Node::with([
                'fieldDataFieldCourseInstructor.fieldCourseInstructorNode',
                'fieldDataFieldInstructor1.fieldDataFieldInstructorNode1',
                'fieldDataFieldInstructor2.fieldDataFieldInstructorNode2',
                'fieldDataFieldInstructor3.fieldDataFieldInstructorNode3',
                'fieldDataFieldInstructor4.fieldDataFieldInstructorNode4',
                'fieldDataFieldInstructor5.fieldDataFieldInstructorNode5',
                'fieldDataFieldInstructor6.fieldDataFieldInstructorNode6',
                'fieldDataFieldInstructor7.fieldDataFieldInstructorNode7',
                'fieldDataFieldInstructor8.fieldDataFieldInstructorNode8',
                'fieldDataFieldInstructor9.fieldDataFieldInstructorNode9',
                'fieldDataFieldInstructor10.fieldDataFieldInstructorNode10',
                'FieldDataFieldSessionLocLocation.fieldDataFieldOnline',
                'FieldDataFieldSessionLocLocation.fieldDataFieldSessionLocation.FieldDataFieldSessionLocationNode'
            ])
            ->join('field_data_field_choose_session_type', 'field_data_field_choose_session_type.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_session_dates', 'field_data_field_session_dates.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_start_date1', 'field_data_field_start_date1.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_start_date2', 'field_data_field_start_date2.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_start_date3', 'field_data_field_start_date3.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_start_date4', 'field_data_field_start_date4.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_start_date5', 'field_data_field_start_date5.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_start_date6', 'field_data_field_start_date6.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_start_date7', 'field_data_field_start_date7.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_start_date8', 'field_data_field_start_date8.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_start_date9', 'field_data_field_start_date9.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_start_date10', 'field_data_field_start_date10.entity_id', '=', 'node.nid')
            ->join('field_data_field_course', 'field_data_field_course.entity_id', '=', 'node.nid')
            ->join('field_data_field_resale', 'field_data_field_resale.entity_id', 'node.nid')
            ->join('field_data_field_procept_sell_ticket_course', 'field_data_field_procept_sell_ticket_course.entity_id', 'field_data_field_resale.field_resale_value')
            ->join('field_data_field_if_yes_eventbrite_link', 'field_data_field_if_yes_eventbrite_link.entity_id', 'field_data_field_resale.field_resale_value')        ->where(function ($query) {
                $query->where('field_data_field_choose_session_type.field_choose_session_type_value', AppConstants::SESSION_TYPE_CONTIGUOUS)
                      ->orWhere('field_data_field_choose_session_type.field_choose_session_type_value', AppConstants::SESSION_TYPE_BROKEN_UP);
            })
            ->where(function ($query) use ($todayDate) {
                $query->where('field_data_field_session_dates.field_session_dates_value', '>=', $todayDate)
                      ->orWhere('field_data_field_start_date1.field_start_date1_value', '>=', $todayDate)
                      ->orWhere('field_data_field_start_date2.field_start_date2_value', '>=', $todayDate)
                      ->orWhere('field_data_field_start_date3.field_start_date3_value', '>=', $todayDate)
                      ->orWhere('field_data_field_start_date4.field_start_date4_value', '>=', $todayDate)
                      ->orWhere('field_data_field_start_date5.field_start_date5_value', '>=', $todayDate)
                      ->orWhere('field_data_field_start_date6.field_start_date6_value', '>=', $todayDate)
                      ->orWhere('field_data_field_start_date7.field_start_date7_value', '>=', $todayDate)
                      ->orWhere('field_data_field_start_date8.field_start_date8_value', '>=', $todayDate)
                      ->orWhere('field_data_field_start_date9.field_start_date9_value', '>=', $todayDate)
                      ->orWhere('field_data_field_start_date10.field_start_date10_value', '>=', $todayDate);
            })
            ->where('field_data_field_procept_sell_ticket_course.field_procept_sell_ticket_course_value', AppConstants::FIELD_RESALES_YES)
            ->where('node.status', AppConstants::NODE_STATUS)
            ->where('field_data_field_course.field_course_target_id', $nodeId)
            ->orderBy('field_data_field_session_dates.field_session_dates_value')
            ->orderBy('field_data_field_start_date1.field_start_date1_value')
            ->orderBy('field_data_field_start_date2.field_start_date2_value')
            ->orderBy('field_data_field_start_date3.field_start_date3_value')
            ->orderBy('field_data_field_start_date4.field_start_date4_value')
            ->orderBy('field_data_field_start_date5.field_start_date5_value')
            ->orderBy('field_data_field_start_date6.field_start_date6_value')
            ->orderBy('field_data_field_start_date7.field_start_date7_value')
            ->orderBy('field_data_field_start_date8.field_start_date8_value')
            ->orderBy('field_data_field_start_date9.field_start_date9_value')
            ->orderBy('field_data_field_start_date10.field_start_date10_value')
            ->paginate(10);

            $this->getUpcomingPublicCourseUrl($getAllUpcomingCoursesSessions);

            return (object) [
                'getAllUpcomingCoursesSessions' => $getAllUpcomingCoursesSessions,
                'getCourseTitle' => $getCourseTitle
              ];
        } catch (\Exception $e) {

            Log::error('Error in fetching all upcoming courses', [
                'function' => 'getAllUpcomingCoursesSessions',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }



    public function getAllCourseType($request, $course_type_slug): object
    {
        try {

            $courseTypeUrl = '';
            //dd($course_type_slug);
            if ($course_type_slug == AppConstants::COURSE_TYPE_PM_COURSES) {
                //pm
                $courseTypeUrl = AppConstants::COURSE_TYPE_PM_COURSES_URL;
            } elseif($course_type_slug == AppConstants::COURSE_TYPE_BDA_COURSES) {
                //bd
                $courseTypeUrl = AppConstants::COURSE_TYPE_BDA_COURSES_URL;

            } elseif($course_type_slug == AppConstants::COURSE_TYPE_IT_COURSES) {
                //it
                $courseTypeUrl = AppConstants::COURSE_TYPE_IT_COURSES_URL;
            } elseif($course_type_slug == AppConstants::COURSE_TYPE_MANAGEMENT_COURSES) {
                //mag
                $courseTypeUrl = AppConstants::COURSE_TYPE_MANAGEMENT_COURSES_URL;
            } elseif($course_type_slug == AppConstants::COURSE_TYPE_AGILE_COURSES) {
                //agile
                $courseTypeUrl = AppConstants::COURSE_TYPE_AGILE_COURSES_URL;
            } elseif($course_type_slug == AppConstants::COURSE_TYPE_TRAIN_THE_TRAINER_COURSES) {
                //train
                $courseTypeUrl = AppConstants::COURSE_TYPE_TRAIN_THE_TRAINER_COURSES_URL;
            } elseif($course_type_slug == AppConstants::COURSE_TYPE_CM_COURSES) {
                //cm
                $courseTypeUrl = AppConstants::COURSE_TYPE_CM_COURSES_URL;
            } elseif($course_type_slug == AppConstants::COURSE_TYPE_LEADERSHIP_COURSES) {
                //cm
                $courseTypeUrl = AppConstants::COURSE_TYPE_LEADERSHIP_COURSES_URL;
            }

            $urlAlias = UrlAlias::where('alias', AppConstants::MENU_BAR_COURSE_TYPE . $course_type_slug)->first();

            if ($urlAlias) {
                $taxonomyTermCourse = preg_quote(AppConstants::TAXONOMY_TERM_COURSE, '/');
                $pattern = '/' . $taxonomyTermCourse . '(\d+)/';
                $matches = [];
                if (preg_match($pattern, $urlAlias->source, $matches)) {
                    $nodeId = $matches[1];
                } else {
                    $nodeId = null;
                }
            } else {
                $nodeId = null;
            }

            $getcourseslevel = TaxonomyVocabulary::where('taxonomy_vocabulary.machine_name', AppConstants::TAXONOMY_VOCABULARY_NAME)
            ->leftJoin('taxonomy_term_data', 'taxonomy_vocabulary.vid', '=', 'taxonomy_term_data.vid')
            ->leftJoin('field_data_field_course_level', 'taxonomy_term_data.tid', '=', 'field_data_field_course_level.field_course_level_tid')
            ->leftJoin('node', 'field_data_field_course_level.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_course_id', 'node.nid', '=', 'field_data_field_course_id.entity_id')
            ->leftJoin('field_data_field_course_type', 'node.nid', '=', 'field_data_field_course_type.entity_id')
            ->leftJoin('field_data_field_duration', 'field_data_field_course_type.entity_id', '=', 'field_data_field_duration.entity_id')
            ->join('field_data_field_active_course', 'field_data_field_active_course.entity_id', '=', 'node.nid')
            ->where('field_data_field_course_type.field_course_type_tid', '=', $nodeId)
            ->where('node.status', AppConstants::NODE_STATUS)
            ->where('field_data_field_active_course.field_active_course_value', AppConstants::FIELD_PUBLIC_VALUE)
            ->orderBy('node.title', 'asc')
            ->get()->map(function ($getcourseslevel) {
                $urlAlias = UrlAlias::where('source', '=', 'node/' . $getcourseslevel->entity_id)
                    ->select('alias')
                    ->first();
                $getcourseslevel->course_url = !empty($urlAlias) ? $urlAlias->alias : '';
                return $getcourseslevel;
            });

            $trainingDetails = $this->getContentByAlias($courseTypeUrl);


            return (object) [
                'trainingDetails' => $trainingDetails,
                'getcourseslevel' => $getcourseslevel
            ];
        } catch (\Exception $e) {

            Log::error('Error in fetching all course type', [
                'function' => 'getAllCourseType',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }


    public function showfilterPageCourse($request): object
    {

        try {
            $search = $request->input('title');

            $filterPageCourse = Node::join('field_data_field_active_course', 'field_data_field_active_course.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_event_type', 'field_data_field_event_type.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_members_visible', 'field_data_field_members_visible.entity_id', '=', 'node.nid')
            ->where(function ($query) {
                $query->where('node.type', AppConstants::ARTICLE)
                      ->orWhere('node.type', AppConstants::PAGE)
                      ->orWhere(function ($query) {
                          $query->where('node.type', AppConstants::NODETYPE_COURSE)
                                ->where('field_data_field_active_course.field_active_course_value', AppConstants::FIELD_ACTIVE_COURSE_VALUE);
                      })
                      ->orWhere(function ($query) {
                          $query->where('node.type', AppConstants::NODETYPE_EVENTS)
                                ->where('field_data_field_event_type.field_event_type_value', AppConstants::FIELD_EVENT_TYPE_VALUE);
                      })
                      ->orWhere(function ($query) {
                          $query->where('node.type', AppConstants::TEAM)
                                ->where('field_data_field_members_visible.field_members_visible_value', AppConstants::FIELD_RESALES_YES);
                      });
            })
            ->where('node.status', AppConstants::NODE_STATUS)
            ->where('node.title', 'LIKE', '%' . $search . '%')
            ->take(3)
            ->get()->map(function ($courseurl) {
                $urlAlias = UrlAlias::where('source', '=', 'node/' . $courseurl->nid)
                    ->select('alias')
                    ->first();
                $courseurl->url = !empty($urlAlias) ? $urlAlias->alias : '';
                return $courseurl;
            });



            return (object) $filterPageCourse;

        } catch (\Exception $e) {

            Log::error('Error in fetching filter course page', [
                'function' => 'showfilterPageCourse',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }

    public function getAllArticlePage($request, $article_title_slug): object
    {
        try {
            $currentUrl = url()->current();
            $decodedUrl = urldecode($currentUrl);
            $baseUrl = url()->to('/');
            $relativeUrl = Str::after($decodedUrl, $baseUrl);
            $segment = AppConstants::COURSES . '/';
            $relativeUrlAfterSegment = Str::after($relativeUrl, $segment);
            $urlAlias = UrlAlias::where('alias', $relativeUrlAfterSegment)->first();
            preg_match('/node\/(\d+)$/', $urlAlias->source, $matches);
            $nodeId = $matches[1];



            $getArticlePage = Node::with('fieldDataBody')->where('node.type', AppConstants::ARTICLE)
            ->where('node.status', AppConstants::NODE_STATUS)
            ->where('node.nid', $nodeId)
            ->first();

            return (object) $getArticlePage;

        } catch (\Exception $e) {

            Log::error('Error in fetching all article page', [
                'function' => 'getAllArticlePage',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }

    public function getAllBasicPage($request, $page_slug): object
    {
        try {
            $currentUrl = url()->current();
            $decodedUrl = urldecode($currentUrl);
            $baseUrl = url()->to('/');
            $relativeUrl = Str::after($decodedUrl, $baseUrl);
            $segment = AppConstants::COURSES . '/';
            $relativeUrlAfterSegment = Str::after($relativeUrl, $segment);
            $urlAlias = UrlAlias::where('alias', $relativeUrlAfterSegment)->first();
            preg_match('/node\/(\d+)$/', $urlAlias->source, $matches);
            $nodeId = $matches[1];



            $getBasicPage = Node::with('fieldDataBody')->where('node.type', AppConstants::PAGE)
            ->where('node.status', AppConstants::NODE_STATUS)
            ->where('node.nid', $nodeId)
            ->first();

            return (object) $getBasicPage;

        } catch (\Exception $e) {

            Log::error('Error in fetching all basic page', [
                'function' => 'getAllBasicPage',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }

    public function getAllTeam($request, $team_slug): object
    {
        try {
            $currentUrl = url()->current();
            $decodedUrl = urldecode($currentUrl);
            $baseUrl = url()->to('/');
            $relativeUrl = Str::after($decodedUrl, $baseUrl);
            $segment = AppConstants::COURSES . '/';
            $relativeUrlAfterSegment = Str::after($relativeUrl, $segment);
            $urlAlias = UrlAlias::where('alias', $relativeUrlAfterSegment)->first();
            preg_match('/node\/(\d+)$/', $urlAlias->source, $matches);


            $nodeId = $matches[1];

            $getTeamPage = Node::join('field_data_field_members_visible', 'field_data_field_members_visible.entity_id', '=', 'node.nid')
            ->join('field_data_field_credentials', 'field_data_field_credentials.entity_id', 'node.nid')
            ->join('field_data_field_team_image', 'field_data_field_team_image.entity_id', 'node.nid')
            ->join('file_managed', 'file_managed.fid', 'field_data_field_team_image.field_team_image_fid')
            ->join('field_data_field_team_summary', 'field_data_field_team_summary.entity_id', 'node.nid')
            ->where('node.type', AppConstants::TEAM)
            ->where('field_data_field_members_visible.field_members_visible_value', AppConstants::FIELD_RESALES_YES)
            ->where('node.status', AppConstants::NODE_STATUS)
            ->where('node.nid', $nodeId)
            ->first();

            return (object) $getTeamPage;

        } catch (\Exception $e) {

            Log::error('Error in fetching all team page', [
                'function' => 'getAllTeam',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }

    public function getTrainingPage($request): object
    {
        return (object) [];
    }

    public function getPMCoursesPage($request): object
    {
        try {
            $urlAlias = UrlAlias::where('alias', AppConstants::MENU_BAR_COURSE_TYPE.AppConstants::COURSE_TYPE_PM_COURSES)->first();

            $taxonomyTermCourse = preg_quote(AppConstants::TAXONOMY_TERM_COURSE, '/');
            $pattern = '/' . $taxonomyTermCourse . '(\d+)/';
            $matches = [];
            if (preg_match($pattern, $urlAlias->source, $matches)) {
                $nodeId = $matches[1];
            } else {
                $nodeId = null;
            }

            $nodeId = $matches[1];

            $getPMCourses = TaxonomyVocabulary::where('taxonomy_vocabulary.machine_name', AppConstants::TAXONOMY_VOCABULARY_NAME)
            ->leftJoin('taxonomy_term_data', 'taxonomy_vocabulary.vid', '=', 'taxonomy_term_data.vid')
            ->leftJoin('field_data_field_course_level', 'taxonomy_term_data.tid', '=', 'field_data_field_course_level.field_course_level_tid')
            ->leftJoin('node', 'field_data_field_course_level.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_course_id', 'node.nid', '=', 'field_data_field_course_id.entity_id')
            ->leftJoin('field_data_field_course_type', 'node.nid', '=', 'field_data_field_course_type.entity_id')
            ->leftJoin('field_data_field_duration', 'field_data_field_course_type.entity_id', '=', 'field_data_field_duration.entity_id')
            ->join('field_data_field_active_course', 'field_data_field_active_course.entity_id', '=', 'node.nid')
            ->where('field_data_field_course_type.field_course_type_tid', '=', $nodeId)
            ->where('node.status', AppConstants::NODE_STATUS)
            ->where('field_data_field_active_course.field_active_course_value', AppConstants::FIELD_PUBLIC_VALUE)
            ->orderBy('node.title', 'asc')
            ->get()->map(function ($getPMCourses) {
                $urlAlias = UrlAlias::where('source', '=', 'node/' . $getPMCourses->entity_id)
                    ->select('alias')
                    ->first();
                $getPMCourses->course_url = !empty($urlAlias) ? $urlAlias->alias : '';
                return $getPMCourses;
            });

            $trainingDetails = $this->getContentByAlias(AppConstants::COURSE_TYPE_PM_COURSES_URL);

            return (object) [
                'trainingDetails' => $trainingDetails,
                'getPMCourses' => $getPMCourses
            ];
        } catch (\Exception $e) {

            Log::error('Error in fetching Project Management Courses Page', [
                'function' => 'getPMCoursesPage',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }

    }

    public function getCMCoursesPage($request): object
    {
        try {
            $urlAlias = UrlAlias::where('alias', AppConstants::MENU_BAR_COURSE_TYPE.AppConstants::COURSE_TYPE_CM_COURSES)->first();

            $taxonomyTermCourse = preg_quote(AppConstants::TAXONOMY_TERM_COURSE, '/');
            $pattern = '/' . $taxonomyTermCourse . '(\d+)/';
            $matches = [];
            if (preg_match($pattern, $urlAlias->source, $matches)) {
                $nodeId = $matches[1];
            } else {
                $nodeId = null;
            }

            $nodeId = $matches[1];

            $getCMCourses = TaxonomyVocabulary::where('taxonomy_vocabulary.machine_name', AppConstants::TAXONOMY_VOCABULARY_NAME)
            ->leftJoin('taxonomy_term_data', 'taxonomy_vocabulary.vid', '=', 'taxonomy_term_data.vid')
            ->leftJoin('field_data_field_course_level', 'taxonomy_term_data.tid', '=', 'field_data_field_course_level.field_course_level_tid')
            ->leftJoin('node', 'field_data_field_course_level.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_course_id', 'node.nid', '=', 'field_data_field_course_id.entity_id')
            ->leftJoin('field_data_field_course_type', 'node.nid', '=', 'field_data_field_course_type.entity_id')
            ->leftJoin('field_data_field_duration', 'field_data_field_course_type.entity_id', '=', 'field_data_field_duration.entity_id')
            ->join('field_data_field_active_course', 'field_data_field_active_course.entity_id', '=', 'node.nid')
            ->where('field_data_field_course_type.field_course_type_tid', '=', $nodeId)
            ->where('node.status', AppConstants::NODE_STATUS)
            ->where('field_data_field_active_course.field_active_course_value', AppConstants::FIELD_PUBLIC_VALUE)
            ->orderBy('node.title', 'asc')
            ->get()->map(function ($getCMCourses) {
                $urlAlias = UrlAlias::where('source', '=', 'node/' . $getCMCourses->entity_id)
                    ->select('alias')
                    ->first();
                $getCMCourses->course_url = !empty($urlAlias) ? $urlAlias->alias : '';
                return $getCMCourses;
            });

            $trainingDetails = $this->getContentByAlias(AppConstants::COURSE_TYPE_CM_COURSES_URL);

            return (object) [
                'trainingDetails' => $trainingDetails,
                'getCMCourses' => $getCMCourses
            ];
        } catch (\Exception $e) {

            Log::error('Error in fetching Change Management Courses Page', [
                'function' => 'getCMCoursesPage',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }

    }
    public function getBACoursesPage($request): object
    {
        try {
            $urlAlias = UrlAlias::where('alias', AppConstants::MENU_BAR_COURSE_TYPE.AppConstants::COURSE_TYPE_BDA_COURSES)->first();

            $taxonomyTermCourse = preg_quote(AppConstants::TAXONOMY_TERM_COURSE, '/');
            $pattern = '/' . $taxonomyTermCourse . '(\d+)/';
            $matches = [];
            if (preg_match($pattern, $urlAlias->source, $matches)) {
                $nodeId = $matches[1];
            } else {
                $nodeId = null;
            }

            $nodeId = $matches[1];

            $getBACourses = TaxonomyVocabulary::where('taxonomy_vocabulary.machine_name', AppConstants::TAXONOMY_VOCABULARY_NAME)
            ->leftJoin('taxonomy_term_data', 'taxonomy_vocabulary.vid', '=', 'taxonomy_term_data.vid')
            ->leftJoin('field_data_field_course_level', 'taxonomy_term_data.tid', '=', 'field_data_field_course_level.field_course_level_tid')
            ->leftJoin('node', 'field_data_field_course_level.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_course_id', 'node.nid', '=', 'field_data_field_course_id.entity_id')
            ->leftJoin('field_data_field_course_type', 'node.nid', '=', 'field_data_field_course_type.entity_id')
            ->leftJoin('field_data_field_duration', 'field_data_field_course_type.entity_id', '=', 'field_data_field_duration.entity_id')
            ->join('field_data_field_active_course', 'field_data_field_active_course.entity_id', '=', 'node.nid')
            ->where('field_data_field_course_type.field_course_type_tid', '=', $nodeId)
            ->where('node.status', AppConstants::NODE_STATUS)
            ->where('field_data_field_active_course.field_active_course_value', AppConstants::FIELD_PUBLIC_VALUE)
            ->orderBy('node.title', 'asc')
            ->get()->map(function ($getBACourses) {
                $urlAlias = UrlAlias::where('source', '=', 'node/' . $getBACourses->entity_id)
                    ->select('alias')
                    ->first();
                $getBACourses->course_url = !empty($urlAlias) ? $urlAlias->alias : '';
                return $getBACourses;
            });

            $trainingDetails = $this->getContentByAlias(AppConstants::COURSE_TYPE_BDA_COURSES_URL);

            return (object) [
                'trainingDetails' => $trainingDetails,
                'getBACourses' => $getBACourses
            ];
        } catch (\Exception $e) {

            Log::error('Error in fetching Business & Data Analysis Courses Page', [
                'function' => 'getBACoursesPage',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }

    }
    public function getleadershipCoursesPage($request): object
    {
        try {
            $urlAlias = UrlAlias::where('alias', AppConstants::MENU_BAR_COURSE_TYPE.AppConstants::COURSE_TYPE_LEADERSHIP_COURSES)->first();

            $taxonomyTermCourse = preg_quote(AppConstants::TAXONOMY_TERM_COURSE, '/');
            $pattern = '/' . $taxonomyTermCourse . '(\d+)/';
            $matches = [];
            if (preg_match($pattern, $urlAlias->source, $matches)) {
                $nodeId = $matches[1];
            } else {
                $nodeId = null;
            }

            $nodeId = $matches[1];

            $getLeadershipCourses = TaxonomyVocabulary::where('taxonomy_vocabulary.machine_name', AppConstants::TAXONOMY_VOCABULARY_NAME)
            ->leftJoin('taxonomy_term_data', 'taxonomy_vocabulary.vid', '=', 'taxonomy_term_data.vid')
            ->leftJoin('field_data_field_course_level', 'taxonomy_term_data.tid', '=', 'field_data_field_course_level.field_course_level_tid')
            ->leftJoin('node', 'field_data_field_course_level.entity_id', '=', 'node.nid')
            ->leftJoin('field_data_field_course_id', 'node.nid', '=', 'field_data_field_course_id.entity_id')
            ->leftJoin('field_data_field_course_type', 'node.nid', '=', 'field_data_field_course_type.entity_id')
            ->leftJoin('field_data_field_duration', 'field_data_field_course_type.entity_id', '=', 'field_data_field_duration.entity_id')
            ->join('field_data_field_active_course', 'field_data_field_active_course.entity_id', '=', 'node.nid')
            ->where('field_data_field_course_type.field_course_type_tid', '=', $nodeId)
            ->where('node.status', AppConstants::NODE_STATUS)
            ->where('field_data_field_active_course.field_active_course_value', AppConstants::FIELD_PUBLIC_VALUE)
            ->orderBy('node.title', 'asc')
            ->get()->map(function ($getLeadershipCourses) {
                $urlAlias = UrlAlias::where('source', '=', 'node/' . $getLeadershipCourses->entity_id)
                    ->select('alias')
                    ->first();
                $getLeadershipCourses->course_url = !empty($urlAlias) ? $urlAlias->alias : '';
                return $getLeadershipCourses;
            });

            $trainingDetails = $this->getContentByAlias(AppConstants::COURSE_TYPE_LEADERSHIP_COURSES_URL);

            return (object) [
                'trainingDetails' => $trainingDetails,
                'getLeadershipCourses' => $getLeadershipCourses
            ];
        } catch (\Exception $e) {

            Log::error('Error in fetching Business & Data Analysis Courses Page', [
                'function' => 'getleadershipCoursesPage',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }

    }

}
