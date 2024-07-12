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

Route::get('/company-news', [HomeController::class, 'getAllCompanyNews'])->name('company.news');
Route::get('/who-we-are', [HomeController::class, 'showWhoWeAre'])->name('who-we-are.show');
Route::get('/management-team', [HomeController::class, 'showManagementTeam'])->name('managementteam.show');
Route::get('/partners', [HomeController::class, 'showPartners'])->name('partners.show');
Route::get('/earningcredits', [HomeController::class, 'showEarning'])->name('earningcredits.show');
Route::get('/exam-pass-guarantees', [HomeController::class, 'showExamPass'])->name('exampassguarantees.show');
Route::get('/case-studies', [HomeController::class, 'showCaseStudies'])->name('casestudies.show');
Route::get('/casestudy/{id}/{url?}/{url2?}', [HomeController::class, 'showCaseStudy'])->name('casestudy.show');
Route::get('/upcoming-public-courses', [HomeController::class, 'showUpcomingPublicCourse'])->name('upcoming.public.course.list');
Route::get('/showevents/{id}/{url?}/{url2?}', [HomeController::class, 'showevents'])->name('showevents');
Route::get('/filter/coursetitle', [HomeController::class, 'showfiltercourse'])->name('filtercourse.show');
Route::get('/filter/coursedescription/{id}/{url?}/{url2?}', [HomeController::class, 'showfilterdescription'])->name('filterdescription.show');
Route::get('/rss-feed', [HomeController::class, 'showRssFeed'])->name('rss.feed');
Route::get('/privacy-policy',[HomeController::class, 'showprivacypolicy'])->name('privacypolicy.show');


