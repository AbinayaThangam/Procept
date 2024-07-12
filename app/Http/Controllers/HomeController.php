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
        return view('pages.contactus');
    }
    public function index(Request $request)
    {

        $events = $this->homeService->index($request);
        $allCompanyNews = $this->homeService->getAllCompanyNews($request)->take(3);
        $upcomingCourses = $this->homeService->showUpcomingCourse($request);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $testimonials = $this->homeService->showTestimonials($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
       

        return view('welcome', compact('events', 'allCompanyNews', 'upcomingCourses', 'promotionalMessageBar','testimonials','menuBarDetails'));
    }
    public function showevents(int $id, Request $request)
    {
        $eventlist = $this->homeService->showevents($id);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
        return view('pages.events.showallevents', compact('eventlist', 'promotionalMessageBar','menuBarDetails'));
    }
    public function showWhoWeAre(Request $request)
    {
        $blockCopyright = $this->homeService->getBlockTableValue($request);
        $aboutus = $this->homeService->showWhoWeAre($request);
        return view('pages.whoweare', compact('aboutus', 'blockCopyright'));
    }
    public function showManagementTeam(Request $request)
    {
        $blockCopyright = $this->homeService->getBlockTableValue($request);
        $aboutus = $this->homeService->showManagementTeam($request);
        return view('pages.management', compact('aboutus', 'blockCopyright'));
    }
    public function showPartners(Request $request)
    {
        $blockCopyright = $this->homeService->getBlockTableValue($request);
        $aboutus = $this->homeService->showPartners($request);
        return view('Pages.partners', compact('aboutus', 'blockCopyright'));
    }
    public function showEarning(Request $request)
    {
        $blockCopyright = $this->homeService->getBlockTableValue($request);
        $aboutus = $this->homeService->showEarning($request);
        return view('Pages.earningcredits', compact('aboutus', 'blockCopyright'));
    }
    public function showExamPass(Request $request)
    {
        $blockCopyright = $this->homeService->getBlockTableValue($request);
        $aboutus = $this->homeService->showExamPass($request);
        return view('Pages.exampassguarantees', compact('aboutus', 'blockCopyright'));
    }
    public function showprivacypolicy(Request $request)
    {
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
        $aboutus = $this->homeService->showprivacypolicy($request);
        return view('Pages.privacypolicy', compact('aboutus', 'promotionalMessageBar','menuBarDetails'));
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
        $blockCopyright = $this->homeService->getBlockTableValue($request);
        return view('pages.casestudylist', compact('case', 'blockCopyright'));
    }
    public function showCaseStudies(Request $request)
    {
        $casestudies = $this->homeService->showCaseStudies();
        $blockCopyright = $this->homeService->getBlockTableValue($request);
        return view('pages.casestudy', compact('casestudies', 'blockCopyright'));
    }
    public function showUpcomingPublicCourse(Request $request)
    {

        $upcomingPublicCourse = $this->homeService->showUpcomingPublicCourse($request);
        $menuBarDetails = $this->homeService->showMenubar($request);
        $promotionalMessageBar = $this->homeService->showPromotionalMessageBar($request);
        return view('pages.upcomingcourse', compact('upcomingPublicCourse','menuBarDetails','promotionalMessageBar'));
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
        return view('pages.companynews', compact('allCompanyNews','promotionalMessageBar','menuBarDetails'));
    }
}
