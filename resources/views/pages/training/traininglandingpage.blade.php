@extends('layouts.home')

@section('content')
@include('layouts.page_nav')

<div class="training-landing-banner">
    <img src="{{ asset('/img/training_landing_bg/training_landing_bg.jpeg') }}" alt="training-banner img"
        class="training-banner">
    <div class="overlay training-landing-container">
        <div class="container training-landing-course">
            <div class="training-landing-title">
                <h3>Training</h3>
            </div>
            <p>At Procept, we offer a comprehensive range of professional courses designed to enhance your skills
                and
                advance your career. Our programs include Project Management, Change Management, Business and Data
                Analytics, leadership, and General Management courses, and much more! Whether you're looking to
                deepen
                the expertise of yourself or your employees, or explore new areas, our courses provide the tools and
                knowledge to achieve your objectives.</p>

        </div>
    </div>
</div>
<section id="courses-category">
    <div class="container">
        <div class="row">
            <div class="col-5th">
                <img src="{{ asset('/img/training_areas/project_management_icon.png') }}"
                    alt="training-courses-banner img" class="training-courses-banner">
                <h4 class="training-category-title">PROJECT MANAGEMENT
                </h4>

                <p class="course-category-title">Acquire the skills to effectively plan, execute,
                    and complete projects to maximize benefits.</p>
                <a href="{{  route('training.pmcourses.page')  }}" target="_blank"><img
                        src="{{ asset('/img/training_areas/project_management_btn.png') }}"
                        alt="training-courses-banner img" class="training-courses-button"></a>
            </div>
            <div class="col-5th">
                <img src="{{ asset('/img/training_areas/change_management_icon.png') }}"
                    alt="training-courses-banner img" class="training-courses-banner">
                <span class="training-category-title">
                    <h4 class="training-category-title">CHANGE MANAGEMENT
                </span></h4>

                <p class="course-category-title">Learn how to successfully
                    manage and implement organizational changes, ensuring smooth transitions.</p>
                <a href="{{ route('training.cmcourses.page') }}" target="_blank"> <img
                        src="{{ asset('/img/training_areas/change_management_btn.png') }}"
                        alt="training-courses-banner img" class="training-courses-button mb-5"></a>
            </div>
            <div class="col-5th">
                <img src="{{ asset('/img/training_areas/business_analytics_icon.png') }}"
                    alt="training-courses-banner img" class="training-courses-banner">

                <h4 class="training-category-title">BUSINESS AND DATA ANALYTICS </h4>

                <p class="course-category-title">Master business processes and gain valuable insights from data, driving
                    informed
                    business decisions.</p>
                <a href="{{ route('training.bacourses.page') }}" target="_blank"> <img
                        src="{{ asset('/img/training_areas/business_analytics_btn.png') }}"
                        alt="training-courses-banner img" class="training-courses-button"></a>
            </div>
            <div class="col-5th">
                <img src="{{ asset('/img/training_areas/leadership_management_icon.png') }}"
                    alt="training-courses-banner img" class="training-courses-banner">

                <h4 class="training-category-title">LEADERSHIP AND MANAGEMENT</h4>

                <p class="course-category-title">Cultivate the qualities and skills necessary to craft strategies and
                    inspire others to
                    achieve success.</p>
                <a href="{{ route('training.leadershipcourses.page') }}" target="_blank"> <img
                        src="{{ asset('/img/training_areas/leadership_management_btn.png') }}"
                        alt="training-courses-banner img" class="training-courses-button"></a>

            </div>
            <div class="col-5th">
                <img src="{{ asset('/img/training_areas/other_courses_icon.png') }}" alt="training-courses-banner img"
                    class="training-courses-banner">
                <h4 class="training-category-title">OTHER COURSES</h4>

                <p class="course-category-title">Explore our diverse selection of other courses designed to help you
                    expand your expertise!.</p>
                <img src="{{ asset('/img/training_areas/other_courses_btn.png') }}" alt="training-courses-banner img"
                    class="training-courses-button mb-3">
            </div>
        </div>
    </div>

    </div>

</section>
<section id="section-upcoming-courses" class="upcoming-course-link">
    <div class="container-fluid">
        <div class="row d-flex mt-3">
            <div class="col-12 col-md-1">
            </div>
            <div class="col-12 col-md-7">
                <div class="course-list mt-2">
                    <h6>UPCOMING PUBLIC COURSES (ONLINE)</h6><br>
                    <div class="upcoming-course-list d-flex flex-column flex-md-row justify-content-between">
                        <div class="upcoming-course-date mb-3 mb-md-0">
                            <p>START DATE</p>
                            @foreach ($upcomingCourses as $courses)
                                                        @php
                                                            $sessionDate = strtotime($courses->field_choose_session_type_value == 'Contiguous' ?
                                                                $courses->field_session_dates_value : $courses->field_start_date1_value);
                                                            $month = date('M', $sessionDate);
                                                        @endphp

                                                        @if ($month == 'May')
                                                                                @if (
                                                                                        $courses->title != 'vacation' ||
                                                                                        $courses->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title != 'vacation'
                                                                                    )
                                                                                                        <p>{{ date('M d', $sessionDate) }}</p>
                                                                                @endif
                                                        @else
                                                                                @if (
                                                                                        $courses->title != 'vacation' ||
                                                                                        $courses->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title != 'vacation'
                                                                                    )
                                                                                                        <p>{{ date('M. d', $sessionDate) }}</p>
                                                                                @endif
                                                        @endif
                            @endforeach
                        </div>
                        <div class="upcoming-course-name truncate mb-8 mb-md-0">
                            <p>COURSE NAME</p>
                            @foreach ($upcomingCourses as $course)
                                                        @if (
                                                                $course->title != 'vacation' &&
                                                                $course->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title != 'vacation'
                                                            )
                                                                                    <p>
                                                                                        @if (
                                                                                                strlen($course->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title)
                                                                                                >= 60
                                                                                            )
                                                                                                                    <span class="short-text-online-course">
                                                                                                                        {!!
                                                                                                    substr(
                                                                                                        $course->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title,
                                                                                                        0,
                                                                                                        60
                                                                                                    ) !!}...</span>
                                                                                                                    <a href="{{ @$course->fieldDataFieldResaleNode->fieldDataFieldProceptSellTicketCourse->fieldDataFieldIfYesEventbriteLinkResale->field_if_yes_eventbrite_link_value }}"
                                                                                                                        target="_blank" class="see-more-link">See more</a>
                                                                                        @else
                                                                                            {!! $course->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title !!}
                                                                                        @endif
                                                                                    </p>
                                                        @endif
                            @endforeach
                        </div>
                        <div class="upcoming-course-register mt-3 mt-md-4">
                            <p></p>
                            @foreach ($upcomingCourses as $courses)
                                                        @if (
                                                                $courses->title != 'vacation' ||
                                                                $courses->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title != 'vacation'
                                                            )
                                                                                    <p><a href="{{ @$courses->fieldDataFieldResaleNode->fieldDataFieldProceptSellTicketCourse->fieldDataFieldIfYesEventbriteLinkResale->field_if_yes_eventbrite_link_value }}"
                                                                                            target="_blank">Register ></a></p>
                                                        @endif
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('upcoming.public.course.list') }}" target="_blank">
                        <button class="upcoming-course-btn-link">ALL UPCOMING COURSES ></button>
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-4 course-img mt-3 mt-md-0">
                <img src="{{asset('/img/upcoming_public_courses/AdobeStock_611993696.jpeg')}}"
                    alt="View All Upcoming Public Courses" class="img-fluid upcoming-courses-img">
            </div>
        </div>
    </div>
</section>
<section id="training-landing-credits">
    <div class="row">
        <div class="col-4">
            <h4 class="training-credits-title">TRAINING EXPERIENCE</h4>
            <p class="training-credits-content">Since 1963, our practical, hands-on training prepares you for real-world
                challenges.</p>
            <a href="#" class="training-credits-link">Learn more ></a>
        </div>
        <div class="col-4">
            <h4 class="earn-credits-title">EARN CREDITS</h4>
            <p class="training-credits-content">Our courses help you earn valuable
                professional certification and continuing education credits to advance your career.</p>
            <a href="{{ route('earningcredits.show') }}" class="earn-credits-link" target="_blank">Learn more ></a>
        </div>
        <div class="col-4">
            <h4 class="exampass-credits-title">EXAM PASS GUARANTEE</h4>
            <p class="training-credits-content">We stand by our training with an exam pass guarantee,ensuring you
                achieve your certification goals.</p>
            <a href="{{ route('exampassguarantees.show') }}" class="exampass-credits-link" target="_blank">Learn more
                ></a>
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