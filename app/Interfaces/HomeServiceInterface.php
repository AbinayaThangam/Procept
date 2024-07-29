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
  public function showevents($request,$events_slug);
  public function getAllCompanyNews($request);
  public function showfiltercourse($request);
  public function showfilterdescription($id);
  public function showPromotionalMessageBar($request);
  public function showTestimonials($request);
  public function showMenubar($request);
  public function industryRecoginationLogoslider($request);
  public function contactInformationBlock($request);
  public function getRssFeed($request);
  public function getAllUpcomingCourses($request,$course_slug);
  public function getAllUpcomingCoursesSessions($request,$course_slug);
  public function showCourseType($request);
  public function getAllCourseType($request,$course_type_slug);
  public function showfilterPageCourse($request);

 public function getAllArticlePage($request,$article_title_slug);
 public function getAllBasicPage($request,$page_slug);
 public function getAllTeam($request,$team_slug);
 public function getTrainingPage($request);
 public function getPMCoursesPage($request);
 public function getCMCoursesPage($request);
 public function getBACoursesPage($request);
 public function getleadershipCoursesPage($request);

}


