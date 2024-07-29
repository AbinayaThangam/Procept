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
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $contactInfoDetails = $this->homeService->contactInformationBlock($request);
        return view('pages.contactus', compact('contactInfoDetails', 'menuBarDetails', 'promotionalMessageBar', 'trainingMenuBarDetails'));
    }
    public function index(Request $request)
    {
        $events = $this->homeService->index($request);
        $allCompanyNews = $this->homeService->getAllCompanyNews($request)->take(3);
        $upcomingCourses = $this->homeService->showUpcomingCourse($request);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $testimonials = $this->homeService->showTestimonials($request);
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;

        $industryRecLogoslider = $this->homeService->industryRecoginationLogoslider($request);

        return view('welcome', compact('events', 'allCompanyNews', 'upcomingCourses', 'promotionalMessageBar', 'testimonials', 'menuBarDetails', 'industryRecLogoslider', 'trainingMenuBarDetails'));
    }
    public function showevents(Request $request, $events_slug)
    {
        $eventlist = $this->homeService->showevents($request, $events_slug);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        return view('pages.events.showallevents', compact('eventlist', 'promotionalMessageBar', 'menuBarDetails', 'trainingMenuBarDetails'));
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
    public function showEarncredits(Request $request)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);

        $getEarningCredits = $this->homeService->showEarncredits($request);
        return view('Pages.earningcredits', compact('getEarningCredits','menuBarDetails','trainingMenuBarDetails','promotionalMessageBar'));
    }
    public function showExamPassGuarantess(Request $request)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);

        $getExamPassGuarantess = $this->homeService->showExamPassGuarantess($request);
        return view('Pages.exampassguarantees', compact('getExamPassGuarantess','menuBarDetails','trainingMenuBarDetails','promotionalMessageBar'));
    }
    public function showprivacypolicy(Request $request)
    {
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $aboutus = $this->homeService->showprivacypolicy($request);
        return view('Pages.privacypolicy', compact('aboutus', 'promotionalMessageBar', 'menuBarDetails', 'trainingMenuBarDetails'));
    }
    public function getContentByAlias(Request $alias)
    {

        return $this->homeService->getContentByAlias($alias);
    }
    public function getallevents(Request $request)
    {
        $listallevents = $this->homeService->getallevents($request);

        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        return view('pages.listallevents', compact('listallevents', 'promotionalMessageBar', 'menuBarDetails', 'trainingMenuBarDetails'));
    }
    public function showCaseStudy(int $id, Request $request)
    {

        $case = $this->homeService->showCaseStudy($id);
        return view('pages.casestudylist', compact('case'));
    }
    public function showCaseStudies(Request $request)
    {
        $casestudies = $this->homeService->showCaseStudies();
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        return view('pages.casestudy', compact('casestudies', 'promotionalMessageBar', 'menuBarDetails', 'trainingMenuBarDetails'));
    }
    public function showUpcomingPublicCourse(Request $request)
    {

        $upcomingPublicCourse = $this->homeService->showUpcomingPublicCourse($request);
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        return view('pages.upcoming_courses.upcomingcourse', compact('upcomingPublicCourse', 'menuBarDetails', 'promotionalMessageBar', 'trainingMenuBarDetails'));
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
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        return view('pages.showsearchcourse', compact('filterdescription', 'promotionalMessageBar', 'menuBarDetails', 'trainingMenuBarDetails'));
    }
    public function getAllCompanyNews(Request $request)
    {
        $allCompanyNews = $this->homeService->getAllCompanyNews($request);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        return view('pages.companynews', compact('allCompanyNews', 'promotionalMessageBar', 'menuBarDetails', 'trainingMenuBarDetails'));
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
        $iframeSrcs = $getAllUpcomingCourses->videolinkiframe ?? [];
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;

        return view('pages.upcoming_courses.listupcomingcourse', [
            'promotionalMessageBar' => $promotionalMessageBar,
            'menuBarDetails' => $menuBarDetails,
            'trainingMenuBarDetails' => $trainingMenuBarDetails,
            'courseData' => $courseData,
            'testimonialsData' => $testimonialsData,
            'upcomingSessionData' => $upcomingSessionData,
            'videoTestinomialsData' => $videoTestinomialsData,
            'videolinkiframe' => $iframeSrcs,
        ]);
    }


    public function getAllUpcomingCoursesSessions(Request $request, $course_title_slug)
    {

        $getAllUpcomingCoursesSessions = $this->homeService->getAllUpcomingCoursesSessions($request, $course_title_slug);
        $courseSessionsData = $getAllUpcomingCoursesSessions->getAllUpcomingCoursesSessions ?? null;
        $courseTitleData = $getAllUpcomingCoursesSessions->getCourseTitle ?? [];

        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;

        return view('pages.upcoming_courses.upcomingsessioncourses', [
            'promotionalMessageBar' => $promotionalMessageBar,
            'menuBarDetails' => $menuBarDetails,
            'trainingMenuBarDetails' => $trainingMenuBarDetails,
            'courseSessionsData' => $courseSessionsData,
            'courseTitleData' => $courseTitleData
        ]);
    }

    public function showCourseType(Request $request)
    {

        $coursetype = $this->homeService->showCourseType($request);
        return view('pages.training.listtrainingcourses', compact('coursetype'));
    }

    public function getAllCourseType(Request $request, $course_type_slug)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);

        $courseTypeData = $this->homeService->getAllCourseType($request, $course_type_slug);
        $trainingDetails = $courseTypeData->trainingDetails;
        $getcourseslevel = $courseTypeData->getcourseslevel;


        return view('pages.training.trainingcoursepage', compact('courseTypeData', 'menuBarDetails', 'trainingMenuBarDetails', 'promotionalMessageBar', 'trainingDetails', 'getcourseslevel'));
    }
    public function showfilterPageCourse(Request $request)
    {
        $filterPageCourse = $this->homeService->showfilterPageCourse($request);

        return response()->json(['filterPageCourse' => $filterPageCourse]);

    }
    public function getAllArticlePage(Request $request, $article_title_slug)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);

        $getArticlePage = $this->homeService->getAllArticlePage($request, $article_title_slug);

        return view('pages.article.articlepage', compact('getArticlePage', 'menuBarDetails', 'trainingMenuBarDetails', 'promotionalMessageBar'));

    }

    public function getAllBasicPage(Request $request, $page_slug)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);

        $getBasicPage = $this->homeService->getAllBasicPage($request, $page_slug);

        return view('pages.basic_page.basic_page', compact('getBasicPage', 'menuBarDetails', 'trainingMenuBarDetails', 'promotionalMessageBar'));

    }
    public function getAllTeam(Request $request, $team_slug)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);

        $getTeamPage = $this->homeService->getAllTeam($request, $team_slug);

        return view('pages.team.teampage', compact('getTeamPage', 'menuBarDetails', 'trainingMenuBarDetails', 'promotionalMessageBar'));

    }
    public function getTrainingPage(Request $request)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $upcomingCourses = $this->homeService->showUpcomingCourse($request);
        $getTrainingPage = $this->homeService->getTrainingPage($request);

        return view('pages.training.traininglandingpage', compact('getTrainingPage','upcomingCourses','menuBarDetails', 'trainingMenuBarDetails', 'promotionalMessageBar'));

    }
    public function getCoursesDetails(Request $request,$course_alias, $course_type_alias)
    {
        return $this->homeService->getCoursesDetails($request,$course_alias,$course_type_alias);
    }

    public function getPMCoursesPage(Request $request)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);

        $PmCoursesPageDetails = $this->homeService->getPMCoursesPage($request);
        $trainingDetails = $PmCoursesPageDetails->trainingDetails;
        $getPMCourses = $PmCoursesPageDetails->getCoursesDetails;

        return view('pages.upcoming_courses.pmcourses', compact('getPMCourses', 'trainingDetails','menuBarDetails', 'trainingMenuBarDetails', 'promotionalMessageBar'));

    }

    public function getCMCoursesPage(Request $request)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);

        $CMCoursesPageDetails = $this->homeService->getCMCoursesPage($request);
        $trainingDetails = $CMCoursesPageDetails->trainingDetails;
        $getCMCourses = $CMCoursesPageDetails->getCoursesDetails;

        return view('pages.upcoming_courses.cmcourses', compact('getCMCourses', 'trainingDetails','menuBarDetails', 'trainingMenuBarDetails', 'promotionalMessageBar'));

    }

    public function getBACoursesPage(Request $request)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);

        $BACoursesPageDetails = $this->homeService->getBACoursesPage($request);
        $trainingDetails = $BACoursesPageDetails->trainingDetails;
        $getBACourses = $BACoursesPageDetails->getCoursesDetails;

        return view('pages.upcoming_courses.bacourses', compact('getBACourses', 'trainingDetails','menuBarDetails', 'trainingMenuBarDetails', 'promotionalMessageBar'));

    }
    public function getleadershipCoursesPage(Request $request)
    {
        $menuBar = $this->homeService->showMenubar($request);
        $menuBarDetails = $menuBar->menuBarDetails;
        $trainingMenuBarDetails = $menuBar->trainingMenuBarDetails;
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);

        $leadershipCoursesPageDetails = $this->homeService->getleadershipCoursesPage($request);
        $trainingDetails = $leadershipCoursesPageDetails->trainingDetails;
        $getLeadershipCourses = $leadershipCoursesPageDetails->getCoursesDetails;

        return view('pages.upcoming_courses.leadershipcourses', compact('getLeadershipCourses', 'trainingDetails','menuBarDetails', 'trainingMenuBarDetails', 'promotionalMessageBar'));

    }



}
