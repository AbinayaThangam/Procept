@extends('layouts.home')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@include('layouts.nav')
@include('layouts.header')
<section class="container">
    <div class="row">
        <div class="col-md-4 graphical-content-menu">
            <div class="content-menu-title">
                <div class="icon-box">
                    <div class="training-link py-4">
                        <a href="{{  \App\Constants\AppConstants::TRAINING_URL }}" target="_blank"><img
                                src="{{asset('/img/services_image/Consulting Icon.png')}}" alt="one1"></a>
                    </div>

                    <a href="{{  \App\Constants\AppConstants::TRAINING_URL }}" target="_blank">
                        <h6>TRAINING</h6>
                    </a>
                </div>
                <div class="content-menu-subcontent">
                    <p>Discover our trained training approach, extensive course catalog, and credit earning
                        opportunities to advance your career. Start your learning journey with us today!</p>
                </div>
                <div class="content-menu-btn">
                    <a href="{{  \App\Constants\AppConstants::TRAINING_URL }}" target="_blank"> <img
                            src="{{asset('/img/services_image/Orange Learn More Button.png')}}" alt="learn-icon"></a>
                </div>
            </div>
        </div>

        <div class="col-md-4 graphical-content-menu">

            <div class="content-menu-title">
                <div class="training-link py-4">
                    <a href="{{  \App\Constants\AppConstants::PROCEPT_COM }}" target="_blank"> <img
                            src="{{asset('/img/services_image/Consulting Icon.png')}}" alt="consulting-icon"></a>
                </div>
                <a href="{{  \App\Constants\AppConstants::PROCEPT_COM }}" target="_blank">
                    <h6>CONSULTING</h6>
                </a>
                <div class="content-menu-subcontent">
                    <p>Unlock success with our consulting services. Benefits from expert advisory support and
                        explore our detailed case studies.Partner withus to achieve your business goals</p>
                </div>
                <div class="content-menu-btn">
                    <a href="{{  \App\Constants\AppConstants::PROCEPT_COM }}" target="_blank"> <img
                            src="{{asset('/img/services_image/Blue Learn More Button.png')}}" alt="learn-icon"></a>
                </div>
            </div>
        </div>
        <div class="col-md-4 graphical-content-menu">

            <div class="content-menu-title">
                <div class="training-link py-4">
                    <a href="{{  \App\Constants\AppConstants::PROCEPT_COM }}" target="_blank"> <img
                            src="{{asset('/img/services_image/Consulting Icon.png')}}" alt="one1"></a>
                </div>
                <a href="{{  \App\Constants\AppConstants::PROCEPT_COM }}" target="_blank">
                    <h6>ABOUT US</h6>
                </a>
                <div class="content-menu-subcontent">
                    <p>Discover who we are ,meet our dedicated management team and expert trainers, and learn about
                        our valued partners.Join us and thrive together</p>
                </div>
                <div class="content-menu-btn">
                    <a href="{{  \App\Constants\AppConstants::PROCEPT_COM }}" target="_blank"> <img
                            src="{{asset('/img/services_image/Green Learn More Button.png')}}" alt="learn-icon"></a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="upcoming-course-link mt-5">
    <div class="container-fluid ">
        <div class="row d-flex">
            <div class="col-1">
            </div>
            <div class="col-7">
                <div class="course-list mt-2">
                    <h6>UPCOMING PUBLIC COURSES (ONLINE)</h6><br>
                    <div class="upcoming-course-list d-flex justify-content-between">
                        <div class="upcoming-course-date">
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
                        <div class="upcoming-course-name truncate">
                            <p>COURSE NAME</p>
                            @foreach ($upcomingCourses as $course)
                                                        @if (
                                                                $course->title != 'vacation' &&
                                                                $course->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title != 'vacation'
                                                            )
                                                                                    <p>
                                                                                        @if (strlen($course->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title) >= 60)
                                                                                            <span class="short-text-online-course">
                                                                                                {!! substr($course->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title, 0, 60) !!}...</span>
                                                                                            <a href="{{ @$course->fieldDataFieldResaleNode->fieldDataFieldProceptSellTicketCourse->fieldDataFieldIfYesEventbriteLinkResale->field_if_yes_eventbrite_link_value }}"
                                                                                                target="_blank" class="see-more-link">See more</a>
                                                                                        @else
                                                                                            {!! $course->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title !!}
                                                                                        @endif
                                                                                    </p>
                                                        @endif
                            @endforeach
                        </div>
                        <div class="upcoming-course-register mt-4">
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

                    <a href="{{  \App\Constants\AppConstants::ALL_UPCOMING_COURSES }}" target="_blank"> <button
                            class="upcoming-course-btn-link">ALL UPCOMING COURSES ></button></a>
                </div>
            </div>
            <div class="col-4 course-img">
                <img src="{{asset('/img/upcoming_public_courses/AdobeStock_611993696.jpeg')}}"
                    alt="View All Upcoming Public Courses" class="upcoming-courses-img">
            </div>

        </div>
    </div>

</section>
<section class="events">
    <div class="container-fluid">
        <div class="row d-flex">

            <div class="col-4 event-img">

                <img src="{{asset('/img/upcoming_events/AdobeStock_824701917.jpeg')}}" alt="learn-icon">
            </div>
            <div class="col-7">
                <div class="event-list mt-5">
                    <h6>UPCOMING EVENTS</h6>
                    <div class="upcoming-event-list d-flex justify-content-between">

                        <div class="upcoming-event-date">
                            @foreach ($events as $event)
                                                        @php
                                                            $month = date("M", strtotime($event->field_event_date_value));
                                                        @endphp
                                                        @if ($month === "May")
                                                            <p>{{ date("M j", strtotime($event->field_event_date_value)) }}</p>
                                                        @else
                                                            <p>{{ date("M. j", strtotime($event->field_event_date_value)) }}</p>
                                                        @endif
                            @endforeach

                        </div>
                        <div class="upcoming-event-free">
                            @foreach ($events as $event)
                                <p class="event-free-btn"> <img src="{{asset('/img/upcoming_events/Free icon.png')}}"
                                        class="event-btn" alt="event-icon"></p>
                            @endforeach


                        </div>
                        <div class="upcoming-event-name truncate">
                            @foreach ($events as $event)
                                <p> @if (strlen($event->title) >= 150)
                                    <span class="short-event-title">
                                        {{ substr($event->title, 0, 150) }}..
                                    </span>
                                    <a href="{{ route('showevents', ['id' => $event->nid, 'url' => $event->url]) }}"
                                        target="_blank" class="see-more-event">See more</a>
                                @else
                                    {{ $event->title }}
                                @endif
                                </p>

                            @endforeach
                        </div>

                        <div class="upcoming-event-register">
                            @foreach ($events as $event)

                                <p><a href="{{ route('showevents', ['id' => $event->nid, 'url' => $event->url]) }}">Register
                                        ></a></p>
                            @endforeach

                        </div>

                    </div>
                    <a href="{{ route('getallevents') }}" target="_blank" class="event-btn"><img
                            src="{{asset('/img/upcoming_events/All Events Button.png')}}" alt="event-icon"></a>
                </div>
                <div class="col-1">
                </div>

            </div>

        </div>
    </div>

</section>

<section class="customer-saying">

    <div id="carousel" class="customer-saying-carousel w-100" style="position: relative;">

        <div class="carousel-button carousel-button-left">
            <span class="fa fa-angle-left"></span>
        </div>
        <div class="container">
            <h6 class="customer-saying-title">WHAT OUR CUSTOMERS ARE SAYING</h6>
            <ul class="testimonial-list">

                @foreach ($testimonials as $details)
                                <li>
                                    <div class="testimonial-content">

                                        @php
                                            $body_value = isset($details->fieldDataBody->body_value) ? $details->fieldDataBody->body_value :
                                                '';
                                            $field_data_body_value = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $body_value);
                                        @endphp

                                        <p>{!! $field_data_body_value !!}</p>

                                        <span><i>{{ @$details->fieldDataFieldSpeaker->field_speaker_value }} </i></span>
                                    </div>
                                    <div class="testimonial-image-container">
                                        @if(
                                                $details->fieldDataFieldHomepageTestimonialImage->fileManagedHomepageTestimonialImage->filename
                                                != ''
                                            )
                                                                <img class="testimonial-image"
                                                                    src="{{ asset(\App\Constants\AppConstants::FILE_FOLDER . '/' . @$details->fieldDataFieldHomepageTestimonialImage->fileManagedHomepageTestimonialImage->filename) }}"
                                                                    alt="">
                                        @endif
                                    </div>
                                </li>
                @endforeach
            </ul>
        </div>
        <div class="carousel-button carousel-button-right">
            <span class="fa fa-angle-right"></span>
        </div>
    </div>
</section>

<section class="company-news-link">
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="col-3">
                <div class="news-menu-img">

                    <img src="{{asset('/img/company_news/AdobeStock_423577784.jpeg')}}" class="news-img"
                        alt="learn-icon">
                </div>
            </div>

            <div class="col-9 mt-5">
                <div class="news-list mt-2">
                    <h6>COMPANY NEWS <img src="{{asset('/img/company_news/RSS icon.png')}}" class="rss-news-img"
                            alt="RSS-icon"></h6>
                    <div class="company-news-list d-flex company-news">
                        <div class="company-news-menu">
                            @foreach ($allCompanyNews as $item)

                                @if ($item->filename != '')
                                    <p>
                                        <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . $item->url }}">
                                            <img src="{{ asset(\App\Constants\AppConstants::FILE_FOLDER . $item->filename) }}"
                                                class="menu-news-img mt-4">
                                        </a>
                                    </p>

                                @endif
                            @endforeach
                        </div>
                        <div class="company-news-list-menu mt-3">
                            @foreach ($allCompanyNews as $item)
                                <p class="company-news-content">
                                    <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . $item->url }}" target="_blank">
                                        @if($item->titleOne)
                                            <span class="title-part-1">{{ $item->titleTwo }} |</span>
                                            <span class="title-part-2">{{ $item->titleOne}}</span></a>
                                        @else
                                            <span class="title-part-2">{{ $item->titleTwo}}</span></a>
                                        @endif

                                    <span class="body-summary">

                                        @if (strlen($item->fieldDataBody->body_summary) >= 150)
                                            <span class="short-text">
                                                {!! substr($item->fieldDataBody->body_summary, 0, 150) !!}...</span>
                                            <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . $item->url }}"
                                                target="_blank" class="see-more-link">See more</a>
                                        @else
                                            {!! ($item->fieldDataBody->body_summary) !!}
                                        @endif
                                    </span>

                                </p>
                            @endforeach
                        </div>
                    </div>
                    <div class="more-news">
                        <a href="#"><img src="{{asset('/img/company_news/More Button.png')}}" class="news-more-img"
                                alt="learn-icon"></a>
                    </div>
                </div>
            </div>

</section>
<section class="industry-link  mt-5">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-6">
                <div class="industry-list">
                    <h6>INDUSTRY RECOGNITION</h6>
                    <div class="industry-menu-list">
                        <div class="industry-text-content">
                            <span>In addition to numerous industry accreditations (PMI-ATP, IIBA EEP, APMG ATO, CCA Gold
                                Seal, etc.), Procept and its subsidiaries have earned numerous prestigious awards for
                                our training and consulting including awards from the Project Management Institute (PMI)
                                who named us “Continuing Professional Education Provider of the Year”, Institute for
                                Performance and Learning (I4PL) who gave us their “Gold Award for Training Excellence”,
                                the Conference Board of Canada, and<i> HR Magazine.</i>
                            </span><a href="#">View all></a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="logos-slider">
                    <div class="slide">
                        <img src="{{asset('/img/industry_recognition/Gold Seal Accreditation logo.png')}}" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{asset('/img/industry_recognition/PMI 2024 ATP logo.png')}}" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{asset('/img/industry_recognition/PMI 2024 ATP logo.png')}}" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{asset('/img/industry_recognition/Gold Seal Accreditation logo.png')}}" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{asset('/img/industry_recognition/PMI 2024 ATP logo.png')}}" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{asset('/img/industry_recognition/Gold Seal Accreditation logo.png')}}" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{asset('/img/industry_recognition/PMI 2024 ATP logo.png')}}" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{asset('/img/industry_recognition/Gold Seal Accreditation logo.png')}}" alt="">
                    </div>
                    <div class="slide">
                        <img src="{{asset('/img/industry_recognition/PMI 2024 ATP logo.png')}}" alt="">
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<section class="bottom-menu mt-5 justify-content-between py-5">
    <div class="container">
        <div class="bottom-menu-list">
            <div class="row d-flex">
                <div class="col-4">
                    <div class="bottom-menu-logo">
                        <a href="{{ \App\Constants\AppConstants::PROCEPT_COM }}" target="_blank"><img
                                src="{{ asset('/img/information/Procept Logo.png') }}" alt="Logo" width="260"
                                height="80"></a>
                    </div>
                    <span class="bottom-logo-text">Improving your project <br> delivery excellence.</span>
                </div>
                <div class="col-4">
                    <div class="bottom-menu-location">
                        <h6>HEAD OFFICE</h6>
                        <p>Procept Associates Ltd.<br> 18 King St. East, Suite 1400 <br>Toronto, ON M5C IC4 </p>
                        <p><a href="tel:1-800-261-6861 ">1-800-261-6861</a> |
                            <a href="mailto:info@procept.com" class="footer-mail-link">info@procept.com</a>
                        </p>
                        <a href="{{ \App\Constants\AppConstants::CONTACT_PAGE}}" target="_blank"><img
                                src="{{ asset('/img/information/Other Locations Button.png') }}" class="location-btn"
                                alt="our-location"></a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="bottom-menu-working-with-us">
                        <h6>WORKING WITH US</h6>
                        <ul class="working-with-us-menu">
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Paying Bills</a></li>
                            <li><a href="#">Request a Price Quote</a></li>
                            <li><a href="{{ \App\Constants\AppConstants::CUSTOMER_PORTAL }}" target="_blank">Customer
                                    Portal</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
@endsection