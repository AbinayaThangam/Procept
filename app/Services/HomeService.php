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
    public function showevents($id)
    {
        return $this->homeRespository->showevents($id);
    }
    public function showManagementTeam($request)
    {
        return $this->homeRespository->showManagementTeam($request);
    }
    public function showPartners($request)
    {
        return $this->homeRespository->showPartners($request);
    }
    public function showEarning($request)
    {
        return $this->homeRespository->showEarning($request);
    }
    public function showExamPass($request)
    {
        return $this->homeRespository->showExamPass($request);
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
     public function showTrainingDetails($id)
    {
        return $this->homeRespository->showTrainingDetails( $id);
    }
    public function showCourseType($request)
    {
        return $this->homeRespository->showCourseType($request);
    }


}

