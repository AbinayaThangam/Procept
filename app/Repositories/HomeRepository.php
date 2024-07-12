<?php

namespace App\Repositories;

use Exception;
use Carbon\Carbon;
use App\Models\Node;
use App\Models\Block;
use App\Models\Events;
use App\Models\Contact;
use App\Models\UrlAlias;
use App\Mail\ContactFormMail;
use App\Models\FieldDataBody;
use App\Constants\AppConstants;
use App\Models\PublicPromoMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeRepository
{

    public function contact($request): object
    {
        try {

            $recipients = Contact::where('cid', '=', AppConstants::CONTACT_CID)->first();

            if (!$recipients) {
                return response()->json(['message' => 'No recipients found.'], 404);
            }
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
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
    public function index($request): object
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
    public function showevents(int $id)
    {
        try {

            $result = Node::leftJoin('field_data_body', 'field_data_body.entity_id', '=', 'node.nid')
                ->where('node.nid', $id)
                ->select('node.nid', 'node.title', 'field_data_body.body_value')
                ->first();
            if ($result->body_value) {
                $result->body_value = str_replace(['[button type="button class="dexp-btn-reflect"]Register Here[/button]'], ['REGISTER HERE'], $result->body_value);
            }
            return $result;
        } catch (\Exception $e) {
            Log::error('Error in fetching allevents', [
                'function' => 'showevents',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return [];
        }
    }

    public function getBlockTableData($request): object
    {
        try {
            $blockCopyright = Block::with('blockCopyRight')->where('region', 'copyright')->where('visibility', '0')->where('theme', 'exception')->get();
            return $blockCopyright;
        } catch (\Exception $e) {
            Log::error('Error in fetching events', [
                'function' => 'getBlockTableData',
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
                    $aboutus->body_value = str_replace('<p>1. You can send e-mail to: info@procept.com</p>', '<p>1. You can send e-mail to: <a href="mailto:info@procept.com" class="footer-mail-link"> info@procept.com</p></a>', $aboutus->body_value);

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

            $listallevents = Node::join('field_data_field_event_type', 'field_data_field_event_type.entity_id', '=', 'node.nid')
                ->leftJoin('field_data_field_event_date', 'field_data_field_event_date.entity_id', '=', 'node.nid')
                ->where('field_data_field_event_type.field_event_type_value', '=', AppConstants::FIELD_EVENT_TYPE_VALUE)
                ->whereDate('field_data_field_event_date.field_event_date_value', '>=', Carbon::today())
                ->select('node.title', 'field_data_field_event_date.field_event_date_value', 'node.nid')
                ->orderBy('field_data_field_event_date.field_event_date_value', 'asc')
                ->get()
                ->map(function ($event) {
                    $event->formatted_date = Carbon::parse($event->field_event_date_value)->format('l, F j, Y - H:i');
                    return $event;
                });

            // dd($listallevents->field_event_date_value);

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
                ->take(3)
                ->get()
                ->map(function ($item) {
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

            Log::error('Error in fetching upcoming public list', [
                'function' => 'showUpcomingCourse',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }

    }
    public function showfiltercourse($request): object
    {
        try {
            $search = $request->input('title');
            $filtercourse = Node::join('field_data_field_active_course', 'field_data_field_active_course.entity_id', '=', 'node.nid')
                ->where('node.type', '=', AppConstants::NODETYPE_COURSE)
                ->where('node.status', '=', AppConstants::NODE_COURSE_STATUS)
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
            $menuBarDetails = [
                [
                    'title' => AppConstants::MENU_TRAINING,
                    'submenus' => [
                        ['title' => AppConstants::SUBMENU_COURSE_CATALOGUE],
                        ['title' => AppConstants::SUBMENU_UPCOMING_PUBLIC_COURSES, 'url' => AppConstants::ALL_UPCOMING_COURSES],
                        ['title' => AppConstants::SUBMENU_CUSTOM_COURSES],
                        ['title' => AppConstants::SUBMENU_NEEDS_ASSESSMENTS],
                        ['title' => AppConstants::SUBMENU_EXPERIENCE],
                        ['title' => AppConstants::SUBMENU_EARNING_CREDITS, 'url' => AppConstants::EARN_CREDITS_URL],
                        ['title' => AppConstants::SUBMENU_EXAM_PASS_GUARANTEE, 'url' => AppConstants::EXAM_PASS_GUARANTEE_URL],
                    ],
                ],
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

            return (object) $menuBarDetails;
        } catch (Exception $e) {
            Log::error('Error in fetching Menu Bar', [
                'function' => 'showMenubar',
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return (object) [];
        }
    }

}
