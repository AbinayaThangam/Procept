<?php

namespace App\Interfaces;

interface HomeServiceInterface
{
  public function contact($request);

  public function index($request);
  public function getallevents($request);
  public function showWhoWeAre($request);
  public function showManagementTeam($request);
  public function showPartners($request);
  public function showEarning($request);
  public function showExamPass($request);
  public function showCaseStudies();
  public function showUpcomingCourse($request);
  public function showUpcomingPublicCourse($request);

  public function showCaseStudy($id);
  public function getContentByAlias($alias);
  public function showevents($id);
  public function getAllCompanyNews($request);
  public function showfiltercourse($request);
  public function showfilterdescription($id);
  public function showPromotionalMessageBar($request);
  public function showTestimonials($request);
  public function showMenubar($request);
  public function industryRecoginationLogoslider($request);
  public function contactInformationBlock($request);
 
}

