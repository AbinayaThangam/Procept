<?php

namespace App\Services;


use App\DTO\ShowEventDTO;
use App\Repositories\HomeRepository;
use App\Interfaces\HomeServiceInterface;
use App\DTO\ContactDTO;
use Illuminate\Support\Collection;

class HomeService implements HomeServiceInterface
{
    protected $homeRespository;

    public function __construct()
    {
        $this->homeRespository = new HomeRepository();
    }

    public function contact($request)
    {
        $contactformdetails = new ContactDTO(
            $request->input('name'),
            $request->input('email'),
            $request->input('subject'),
            $request->input('message')
        );
        return $this->homeRespository->contact($contactformdetails);

    }

    public function index($request)
    {

        return $this->homeRespository->index($request);
    }

    public function getallevents($request)
    {

        return $this->homeRespository->getallevents($request);
    }

    public function showWhoWeAre($request)
    {
        return $this->homeRespository->showWhoWeAre($request);
    }
    public function showevents($request,$events_slug)
    {
        return $this->homeRespository->showevents($request,$events_slug);
    }
    public function showManagementTeam($request)
    {
        return $this->homeRespository->showManagementTeam($request);
    }
    public function showPartners($request)
    {
        return $this->homeRespository->showPartners($request);
    }
    public function showEarncredits($request)
    {
        return $this->homeRespository->showEarncredits($request);
    }
    public function showExamPassGuarantess($request)
    {
        return $this->homeRespository->showExamPassGuarantess($request);
    }
    public function showprivacypolicy($request)
    {
        return $this->homeRespository->showprivacypolicy($request);
    }
    public function showCaseStudy($id)
    {
        return $this->homeRespository->showCaseStudy($id);
    }
    public function showCaseStudies()
    {
        return $this->homeRespository->showCaseStudies();
    }
    public function showUpcomingCourse($request)
    {
        return $this->homeRespository->showUpcomingCourse($request);
    }
    public function showUpcomingPublicCourse($request)
    {
        return $this->homeRespository->showUpcomingPublicCourse($request);
    }
    public function showfiltercourse($request)
    {
        return $this->homeRespository->showfiltercourse($request);
    }


    public function showfilterdescription($id)
    {
        return $this->homeRespository->showfilterdescription($id);
    }

    public function getContentByAlias($alias)
    {
        return $this->homeRespository->getContentByAlias($alias);
    }
    public function getAllCompanyNews($request)
    {
        return $this->homeRespository->getAllCompanyNews($request);
    }
    public function showPromotionalMessageBar($request)
    {
        return $this->homeRespository->showPromotionalMessageBar($request);
    }
    public function showTestimonials($request)
    {
        return $this->homeRespository->showTestimonials($request);
    }
    public function showMenubar($request)
    {
        return $this->homeRespository->showMenubar($request);
    }
    public function industryRecoginationLogoslider($request)
    {
        return $this->homeRespository->industryRecoginationLogoslider($request);
    }
    public function contactInformationBlock($request)
    {
        return $this->homeRespository->contactInformationBlock($request);
    }
    public function getRssFeed($request)
    {
        return $this->homeRespository->getRssFeed($request);
    }
    public function getAllUpcomingCourses($request,$course_slug)
    {
        return $this->homeRespository->getAllUpcomingCourses($request,$course_slug);
    }
    public function getAllUpcomingCoursesSessions($request,$course_slug)
    {
        return $this->homeRespository->getAllUpcomingCoursesSessions($request,$course_slug);
    }
    public function showCourseType($request)
    {
        return $this->homeRespository->showCourseType($request);
    }
    public function getAllCourseType($request,$course_type_slug)
    {
        return $this->homeRespository->getAllCourseType($request,$course_type_slug);
    }

    public function showfilterPageCourse($request)
    {
        return $this->homeRespository->showfilterPageCourse($request);
    }

    public function getAllArticlePage($request,$article_title_slug)
    {
        return $this->homeRespository->getAllArticlePage($request,$article_title_slug);
    }
    public function getAllBasicPage($request,$page_slug)
    {
        return $this->homeRespository->getAllBasicPage($request,$page_slug);
    }
    public function getAllTeam($request,$team_slug)
    {
        return $this->homeRespository->getAllTeam($request,$team_slug);
    }
    public function getTrainingPage($request)
    {
        return $this->homeRespository->getTrainingPage($request);
    }
    public function getCoursesDetails($request,$course_alias,$course_type_alias)
    {
        return $this->homeRespository->getCoursesDetails($request,$course_alias,$course_type_alias);
    }

    public function getPMCoursesPage($request)
    {
        return $this->homeRespository->getPMCoursesPage($request);
    }
    public function getCMCoursesPage($request)
    {
        return $this->homeRespository->getCMCoursesPage($request);
    }
    public function getBACoursesPage($request)
    {
        return $this->homeRespository->getBACoursesPage($request);
    }

    public function getleadershipCoursesPage($request)
    {
        return $this->homeRespository->getleadershipCoursesPage($request);
    }

    public function getCourseTypeImageDetails($course_type_url)
    {
        return $this->homeRespository->getCourseTypeImageDetails($course_type_url);
    }
    public function getCanadaJobGrantPage($request)
    {
        return $this->homeRespository->getCanadaJobGrantPage($request);
    }
   public function getPayingUsPage($request)
    {
        return $this->homeRespository->getPayingUsPage($request);
    }
}

