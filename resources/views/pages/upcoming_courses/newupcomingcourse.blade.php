@extends('layouts.home')

@section('content')
@include('layouts.page_nav')

<div class="training-landing-banner">
    <img src="{{ asset('/img/upcoming_public_courses/upcoming_course_bg.jpeg') }}" alt="upcoming-banner img"
        class="training-banner">
    <div class="overlay training-landing-container">
        <div class="container training-landing-course">
            <div class="training-landing-title">
                <h3>Upcoming Public Courses</h3>
            </div>

        </div>
    </div>
</div>
<section class="upcoming_public_courses-list">
    <div class="container my-5">
        <div class="table-responsive">
            <table class="table  custom-table">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>Start Date</th>
                        <th>Course Name</th>
                        <th>Instructor</th>
                        <th>Register</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-2">
                            <img src="{{ asset('/img/upcoming_public_courses/in_person_course_icon.png') }}"
                                alt="in_person-icon img" class="in_person-icon"><br>
                            <p>Metro Hall(Toronto)</p>
                        </td>
                        <td class="col-1">Sep.16</td>
                        <td class="col-6">Change Management Foundation & Practitionaer(CMP) Certification</td>
                        <td class="col-3">Shawn Pariag</td>
                        <td class="col-1"><a href="#">Details ></a></td>
                    </tr>
                    <tr>
                        <td class="col-2">
                            <img src="{{ asset('/img/upcoming_public_courses/online_course_icon.png') }}"
                                alt="in_person-icon img" class="in_person-icon"><br>
                            <p class="online_text"> Online</p>
                        </td>
                        <td class="col-1">Oct.18</td>
                        <td class="col-6">PMP Exam Preparation</td>
                        <td class="col-3">Janice Petley Peter Monkhouse</td>
                        <td class="col-1"><a href="#">Details ></a></td>
                    </tr>
                    <tr>
                        <td class="col-2">
                            <img src="{{ asset('/img/upcoming_public_courses/online_course_icon.png') }}"
                                alt="in_person-icon img" class="in_person-icon"><br>
                            <p class="online_text"> Online</p>
                        </td>
                        <td class="col-1">Oct.21</td>
                        <td class="col-6">Project Management Essentials</td>
                        <td class="col-3">Ori Schibi</td>
                        <td class="col-1"><a href="#">Details ></a></td>
                    </tr>
                    <tr>
                        <td class="col-2">
                            <img src="{{ asset('/img/upcoming_public_courses/online_course_icon.png') }}"
                                alt="in_person-icon img" class="in_person-icon"><br>
                            <p class="online_text"> Online</p>
                        </td>
                        <td class="col-1">Oct.24</td>
                        <td class="col-6">PMI-ACP* Exam Preparation or Certified Agile Project Manager</td>
                        <td class="col-3"><a href="#">Kevin Agunanno</a></td>
                        <td class="col-1"><a href="#">Details ></a></td>
                    </tr>
                    <tr>
                        <td class="col-2">
                            <img src="{{ asset('/img/upcoming_public_courses/online_course_icon.png') }}"
                                alt="in_person-icon img" class="in_person-icon"><br>
                            <p class="online_text"> Online</p>
                        </td>
                        <td class="col-1">Nov.8</td>
                        <td class="col-6">Change Management Foundation & Practitioner (CMP) Certification</td>
                        <td class="col-3">Janice Petley Peter Monkhouse</td>



                        <td class="col-1"><a href="#">Details ></a></td>
                    </tr>
                    <tr>
                        <td class="col-2">
                            <img src="{{ asset('/img/upcoming_public_courses/in_person_course_icon.png') }}"
                                alt="in_person-icon img" class="in_person-icon"><br>
                            <p>Metro Hall(Toronto)</p>
                        </td>
                        <td class="col-1">Sep.16</td>
                        <td class="col-6">Change Management Foundation & Practitionaer(CMP) Certification</td>
                        <td class="col-3">Shawn Pariag</td>
                        <td class="col-1"><a href="#">Details ></a></td>
                    </tr>
                    <tr>
                        <td class="col-2">
                            <img src="{{ asset('/img/upcoming_public_courses/in_person_course_icon.png') }}"
                                alt="in_person-icon img" class="in_person-icon"><br>
                            <p>Metro Hall(Toronto)</p>
                        </td>
                        <td class="col-1">Sep.16</td>
                        <td class="col-6">Change Management Foundation & Practitionaer(CMP) Certification</td>
                        <td class="col-3">Shawn Pariag</td>
                        <td class="col-1"><a href="#">Details ></a></td>
                    </tr>
                    <tr>
                        <td class="col-2">
                            <img src="{{ asset('/img/upcoming_public_courses/in_person_course_icon.png') }}"
                                alt="in_person-icon img" class="in_person-icon"><br>
                            <p>Metro Hall(Toronto)</p>
                        </td>
                        <td class="col-1">Sep.16</td>
                        <td class="col-6">Change Management Foundation & Practitionaer(CMP) Certification</td>
                        <td class="col-3">Shawn Pariag</td>
                        <td class="col-1"><a href="#">Details ></a></td>
                    </tr>
                    <tr>
                        <td class="col-2">
                            <img src="{{ asset('/img/upcoming_public_courses/online_course_icon.png') }}"
                                alt="in_person-icon img" class="in_person-icon"><br>
                            <p class="online_text"> Online</p>
                        </td>
                        <td class="col-1">Oct.18</td>
                        <td class="col-6">PMP Exam Preparation</td>
                        <td class="col-3">Janice Petley Peter Monkhouse</td>
                        <td class="col-1"><a href="#">Details ></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="advertisement-courses-job">
    <div class="row advertisement">
        <div class="col-6 jobs-ad">
            <img src="{{ asset('/img/training_ads/canada_job_ad.png') }}" alt="canada-ad-banner img"
                class="training-ads-banner">
        </div>
        <div class="col-6 newcomer-ad">
            <img src="{{ asset('/img/training_ads/newcomer_gant_ad.png') }}" alt="newcomer-ad-banner img"
                class="newcomer-ads-banner">
        </div>
    </div>
</section>
@include('layouts.footer')
@endsection