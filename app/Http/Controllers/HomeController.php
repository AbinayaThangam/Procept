<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HomeService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function contact(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $recipients = $this->homeService->contact($request);

        return redirect('/contact')->with('success', 'Your message has been sent successfully!');
    }
    public function show(Request $request)
    {
        $menuBarDetails = $this->homeService->showMenubar($request);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $contactInfoDetails = $this->homeService->contactInformationBlock($request);
        return view('pages.contactus', compact('contactInfoDetails', 'menuBarDetails', 'promotionalMessageBar'));
    }
    public function index(Request $request)
    {
        $events = $this->homeService->index($request);
        $allCompanyNews = $this->homeService->getAllCompanyNews($request)->take(3);
        $upcomingCourses = $this->homeService->showUpcomingCourse($request);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $testimonials = $this->homeService->showTestimonials($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
        $industryRecLogoslider = $this->homeService->industryRecoginationLogoslider($request);

        return view('welcome', compact('events', 'allCompanyNews', 'upcomingCourses', 'promotionalMessageBar', 'testimonials', 'menuBarDetails', 'industryRecLogoslider'));
    }
    public function showevents(int $id, Request $request)
    {
        $eventlist = $this->homeService->showevents($id);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
        return view('pages.events.showallevents', compact('eventlist', 'promotionalMessageBar', 'menuBarDetails'));
    }
    public function showWhoWeAre(Request $request)
    {

        $aboutus = $this->homeService->showWhoWeAre($request);
        return view('pages.whoweare', compact('aboutus'));
    }
    public function showManagementTeam(Request $request)
    {

        $aboutus = $this->homeService->showManagementTeam($request);
        return view('pages.management', compact('aboutus'));
    }
    public function showPartners(Request $request)
    {

        $aboutus = $this->homeService->showPartners($request);
        return view('Pages.partners', compact('aboutus'));
    }
    public function showEarning(Request $request)
    {
        $aboutus = $this->homeService->showEarning($request);
        return view('Pages.earningcredits', compact('aboutus'));
    }
    public function showExamPass(Request $request)
    {
        $aboutus = $this->homeService->showExamPass($request);
        return view('Pages.exampassguarantees', compact('aboutus'));
    }
    public function showprivacypolicy(Request $request)
    {
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
        $aboutus = $this->homeService->showprivacypolicy($request);
        return view('Pages.privacypolicy', compact('aboutus', 'promotionalMessageBar', 'menuBarDetails'));
    }
    public function getContentByAlias(Request $alias)
    {

        return $this->homeService->getContentByAlias($alias);
    }
    public function getallevents(Request $request)
    {
        $listallevents = $this->homeService->getallevents($request);

        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
        return view('pages.listallevents', compact('listallevents', 'promotionalMessageBar', 'menuBarDetails'));
    }
    public function showCaseStudy(int $id, Request $request)
    {

        $case = $this->homeService->showCaseStudy($id);
        return view('pages.casestudylist', compact('case'));
    }
    public function showCaseStudies(Request $request)
    {
        $casestudies = $this->homeService->showCaseStudies();
        $menuBarDetails = $this->homeService->showMenubar($request);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        return view('pages.casestudy', compact('casestudies', 'promotionalMessageBar', 'menuBarDetails'));
    }
    public function showUpcomingPublicCourse(Request $request)
    {

        $upcomingPublicCourse = $this->homeService->showUpcomingPublicCourse($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        return view('pages.upcoming_courses.upcomingcourse', compact('upcomingPublicCourse', 'menuBarDetails', 'promotionalMessageBar'));
    }

    public function showfiltercourse(Request $request)
    {
        $filtercourse = $this->homeService->showfiltercourse($request);

        return response()->json(['filtercourse' => $filtercourse]);

    }

    public function showfilterdescription(int $id, Request $request)
    {
        $filterdescription = $this->homeService->showfilterdescription($id);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
        return view('pages.showsearchcourse', compact('filterdescription', 'promotionalMessageBar', 'menuBarDetails'));
    }
    public function getAllCompanyNews(Request $request)
    {
        $allCompanyNews = $this->homeService->getAllCompanyNews($request);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
        return view('pages.companynews', compact('allCompanyNews', 'promotionalMessageBar', 'menuBarDetails'));
    }
    public function showRssFeed(Request $request)
    {
        $getRssFeed = $this->homeService->getRssFeed($request);

        return response()
            ->view('pages.rssfeed', compact('getRssFeed'))
            ->header('Content-Type', 'text/xml');

    }

    public function getAllUpcomingCourses(Request $request, $course_slug)
    {

        $getAllUpcomingCourses = $this->homeService->getAllUpcomingCourses($request, $course_slug);
        $courseData = $getAllUpcomingCourses->course ?? null;
        $testimonialsData = $getAllUpcomingCourses->testimonials ?? [];
        $upcomingSessionData = $getAllUpcomingCourses->upcomingSession ?? [];
        $videoTestinomialsData = $getAllUpcomingCourses->getVideoTestinomials ?? [];

        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBarDetails = $this->homeService->showMenubar($request);

        return view('pages.upcoming_courses.listupcomingcourse', [
            'promotionalMessageBar' => $promotionalMessageBar,
            'menuBarDetails' => $menuBarDetails,
            'courseData' => $courseData,
            'testimonialsData' => $testimonialsData,
            'upcomingSessionData'=>$upcomingSessionData,
            'videoTestinomialsData'=>$videoTestinomialsData
        ]);
    }
    public function getAllUpcomingCoursesSessions(Request $request, $course_title_slug)
    {

        $getAllUpcomingCoursesSessions = $this->homeService->getAllUpcomingCoursesSessions($request, $course_title_slug);
        $courseSessionsData = $getAllUpcomingCoursesSessions->getAllUpcomingCoursesSessions ?? null;
        $courseTitleData = $getAllUpcomingCoursesSessions->getCourseTitle ?? [];

        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBarDetails = $this->homeService->showMenubar($request);

        return view('pages.upcoming_courses.upcomingsessioncourses', [
            'promotionalMessageBar' => $promotionalMessageBar,
            'menuBarDetails' => $menuBarDetails,
            'courseSessionsData' => $courseSessionsData,
            'courseTitleData' => $courseTitleData
        ]);
    }

 public function showTrainingDetails(int $id, Request $request)
    {
        $getTrainingDetails = $this->homeService->showTrainingDetails($id);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBarDetails = $this->homeService->showMenubar($request);

        $trainingDetails = $getTrainingDetails->trainingDetails;
        $cmCourses = $getTrainingDetails->cmCourses;

        return view(
            'pages.training.listtrainingcourses',
            compact(
                'promotionalMessageBar',
                'menuBarDetails',
                'trainingDetails',
                'cmCourses'
            )
        );

    }
    public function showCourseType(Request $request)
    {
        $coursetype = $this->homeService->showCourseType($request);
        return view('pages.training.listtrainingcourses', compact('coursetype'));
    }
}
