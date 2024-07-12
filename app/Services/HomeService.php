<?php

namespace App\Services;

use App\Repositories\HomeRepository;
use App\Interfaces\HomeServiceInterface;


class HomeService implements HomeServiceInterface
{
    protected $homeRespository;

    public function __construct()
    {
        $this->homeRespository = new HomeRepository();
    }

    public function contact($request)
    {
        return $this->homeRespository->contact($request);
    }

    public function index($request)
    {
        return $this->homeRespository->index($request);
    }
    public function getBlockTableValue($request)
    {
        return $this->homeRespository->getBlockTableData($request);
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
   
  
}
