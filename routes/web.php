<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');


Route::get('/contact', [App\Http\Controllers\HomeController::class, 'show'])->name('contact.show');
Route::post('/contactus', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact.create');

Route::get('/events', [HomeController::class, 'getevents'])->name('getevents');
Route::get('/allevents', [HomeController::class, 'getallevents'])->name('getallevents');
Route::post('/allevents', [HomeController::class, 'getallevents'])->name('filterevents');
Route::get('/company-news', [HomeController::class, 'getAllCompanyNews'])->name('company.news');
Route::get('/who-we-are', [HomeController::class, 'showWhoWeAre'])->name('who-we-are.show');
Route::get('/management-team', [HomeController::class, 'showManagementTeam'])->name('managementteam.show');
Route::get('/partners', [HomeController::class, 'showPartners'])->name('partners.show');
Route::get('/earn-credits', [HomeController::class, 'showEarncredits'])->name('earningcredits.show');
Route::get('/exam-pass-guarantees', [HomeController::class, 'showExamPassGuarantess'])->name('exampassguarantees.show');
Route::get('/case-studies', [HomeController::class, 'showCaseStudies'])->name('casestudies.show');
Route::get('/casestudy/{id}/{url?}/{url2?}', [HomeController::class, 'showCaseStudy'])->name('casestudy.show');
Route::get('/upcoming-public-sessions', [HomeController::class, 'showUpcomingPublicCourse'])->name('upcoming.public.course.list');
Route::get('/filter/coursetitle', [HomeController::class, 'showfiltercourse'])->name('filtercourse.show');
Route::get('/filter/coursedescription/{id}/{url?}/{url2?}', [HomeController::class, 'showfilterdescription'])->name('filterdescription.show');
Route::get('/rss-feed', [HomeController::class, 'showRssFeed'])->name('rss.feed');
Route::post('/upcoming-public-sessions', [HomeController::class, 'showUpcomingPublicCourse'])->name('filterCourses');
Route::get('/privacy-policy', [HomeController::class, 'showprivacypolicy'])->name('privacypolicy.show');


//Training Overview
Route::get('/training', [HomeController::class, 'getTrainingPage'])->name('training.page');
Route::get('/page/project-management-courses', [HomeController::class, 'getPMCoursesPage'])->name('training.pmcourses.page');
Route::get('/change-management-courses', [HomeController::class, 'getCMCoursesPage'])->name('training.cmcourses.page');
Route::get('/page/business-data-analysis-courses', [HomeController::class, 'getBACoursesPage'])->name('training.bacourses.page');
Route::get('/page/leadership-courses', [HomeController::class, 'getleadershipCoursesPage'])->name('training.leadershipcourses.page');




Route::get('courses/{course_slug}/{course_slug1?}/{course_slug2?}', [HomeController::class, 'getAllUpcomingCourses'])->name('upcomingcourses.list');

Route::get('upcoming_sessions/{course_title_slug}/{course_title_slug1?}/{course_title_slug2?}', [HomeController::class, 'getAllUpcomingCoursesSessions'])->name('upcomingcourses.sessions.list');
//training menu
Route::get('course-type/{courses_type}', [HomeController::class, 'getAllCourseType'])->name('course.type.details');


Route::get('/courses_page_nid', [HomeController::class, 'showCoursePageNid'])->name('courses.page.nid');

Route::get('/filter/coursepagetitle', [HomeController::class, 'showfilterPageCourse'])->name('filtercoursepage.show');
Route::get('/filter/coursenodeid/{nid}', [HomeController::class, 'getAllUpcomingCourses'])->name('filtercoursepage.nid');



Route::get('/article/{article_title_slug}/{article_title_slug1?}/{article_title_slug2?}', [HomeController::class, 'getAllArticlePage'])->name('filterarticlepage.view');
Route::get('/events/{events_slug}/{events_slug1?}/{events_slug2?}', [HomeController::class, 'showevents'])->name('showevents');
Route::get('/page/{page_slug}/{page_slug1?}/{page_slug2?}', [HomeController::class, 'getAllBasicPage'])->name('getAllBasicPage');
Route::get('/team/{team_slug}/{team_slug1?}/{team_slug2?}', [HomeController::class, 'getAllTeam'])->name('getAllTeam');

Route::get('/canada-job-grant', [HomeController::class, 'getCanadaJobGrantPage'])->name('canada-job-grant');
Route::get('/paying_us', [HomeController::class, 'getPayingUsPage'])->name('paying-us');

Route::get('/newupcoming-courses', [HomeController::class, 'showupcomingcourses'])->name('upcomingcourses');