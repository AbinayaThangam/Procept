@extends('layouts.home')
@section('content')
<body>
<header class="header-container top-header py-3 justify-content-between">
    <div class="row">
        <div class="col-2 m-auto">
            <a class="navbar-brand" href="{{ config('app_constants.PROCEPT_COM')}}" target="_blank">
                <img src="{{ asset('/img/header_image/procept_logo.png') }}" alt="Logo" width="260" height="80">
            </a>
        </div>

        <div class="col-6 top-menu-bar justify-content-center align-items-center m-auto">
            @foreach($menuBarDetails as $menu)
            <div class="container">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="{{ $menu['url'] ?? '#' }}" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"
                    @if (!empty($menu['url'])) target="_blank" @endif>
                     {{ $menu['title'] }}
                 </a>
                    @if(!empty($menu['submenus']))
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @foreach($menu['submenus'] as $submenu)
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item {{ !empty($submenu['submenus']) ? 'dropdown-toggle' : '' }}" href="{{ $submenu['url'] ?? '#' }}"
                                       @if (!empty($submenu['url'])) target="_blank" @endif>
                                        {{ $submenu['title'] }}
                                    </a>
                                    @if(!empty($submenu['submenus']))
                                        <ul class="dropdown-menu">
                                            @foreach($submenu['submenus'] as $subsubmenu)
                                                <li>
                                                    <a class="dropdown-item" href="{{ $subsubmenu['url'] ?? '#' }}"
                                                       @if (!empty($subsubmenu['url'])) target="_blank" @endif>
                                                        {{ $subsubmenu['title'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @endforeach

        <a href="{{ route('contact.show')}}" class="nav-link" target="_blank">Contact</a>

        </div>

        <div class="col-3  flex justify-content-end d-flex row  align-items-center">
            <div class="training-contact-info align-items-center ">
                <div class="phone-number m-auto">
                    <a href="tel:1-800-261-6861" class="contact-info-link">1-800-261-6861</a>
                </div>
                <div class="phone-number m-auto">
                    <a class="contact-info-link"> |</a>
                </div>
                <div class="mail-logo m-auto">
                    <a href="mailto:info@procept.com" class="contact-info-link">info@procept.com</a>
                </div>
            </div>
        </div>

        <div class="col-1 justify-content-center align-items-center m-auto">
            <div class="training-social-links text-center ">
                <div class="social-icons  justify-content-around d-flex">
                    <a href="https://www.youtube.com/channel/UCtI42RRQ_3lpI8t2Ah1Zthw" target="_blank">
                        <img src="{{ asset('/img/header_image/socialmediayoutube_icon.png') }}" alt="YouTube Icon"
                            width="24" height="50">
                    </a>
                    <a href="https://www.linkedin.com/company/121609/ " target="_blank">
                        <img src="{{ asset('/img/header_image/socialmedialinkedin_icon.png') }}" alt="LinkedIn Icon"
                            width="16" height="50">
                    </a>



                       <a href="{{ route('rss.feed') }}" target="_blank">

                        <img src="{{ asset('/img/header_image/socialmediarss_icon.png') }}" alt="RSS Icon" width="16"
                            height="30">
                    </a>
                </div>
            </div>
        </div>
        <div class="course-level search-container">
                    <div class="col-md-10 d-flex training-search-box">
                        <input placeholder="Search" class="form-control border-0 search-courses">
                        <img src="{{ asset('/img/search_and_video/search_icon.png') }}" alt="search-icon"
                            class="img-fluid training-search-icon search-courses" style="">
                    </div>
                    <div class="training filter-courses-container" style="display: none;">
                        <div id="filter-courses-container" class=" training  container" style="display: none;">
                            <ul id="filter-courses-list" class="list-unstyled" style="display: none;">

                            </ul>
                        </div>
                    </div>
                </div>
    </div>
</header>
<div class="message-bar justify-content-center align-items-center">
    <marquee>
        @foreach ($promotionalMessageBar as $promotional)
            @if (!empty($promotional->url))
                <a href="{{ $promotional->url }}" class="message-link" target="_blank">
                    <p style="display:inline;" class="message-text">{{ $promotional->message }} </p>
                </a>
            @else
                <p style="display:inline;">{{ $promotional->message }}</p>
            @endif
        @endforeach
    </marquee>
</div>

<div class="video-banner-container">
    <div class="training-video-banner">
        <video autoplay muted loop class="video-height">
            <source src="{{asset('/img/4426529-uhd_3840_2160_25fps.mp4')}}" type="video/mp4" class="d-block w-100">
            Your browser does not support the video tag.
        </video>
        <div class="overlay training-text-container">
            <div class="container training-management-course">
                <div class="row">
                    <div class="col-3">
                        <a href="#"> <img src="{{asset('/img/overview_text/apmg_logo.jpg')}}" class="managemnt-logo" alt="APMG-icon"></a>
                    </div>
                    <div class="col-9 training-content">
                        <h2 class="mb-3">{{ $trainingDetails->title }}</h2>
                        <p> {!! $trainingDetails->body_value !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="courses-level-container">
    <div class="courses-level">
        <div class="beginner-course-container">
            <div class="beginner-course mt-5">
                <img src="{{ asset('/img/course_listing/beginner_icon.png') }}" alt="beginner-icon" class="beginner-course-logo">


                @php
$beginnerCourse = $cmCourses->firstWhere('name', 'Beginner');
@endphp

@if ($beginnerCourse)
    <h5 class="beginner-course-title">{{ strtoupper($beginnerCourse->name) }} COURSES</h5>
@endif





            </div>
            <div class="row course-level">
                <div class="col-3 course-id">
                    <p class="sub-title-course">COURSE ID</p>
                    @foreach ($cmCourses as $course)
                    @if ($course->name == 'Beginner')
                        <p>{{ $course->field_course_id_value }}</p>
                        @endif
                    @endforeach
                </div>
                <div class="col-6 course-name">
                    <p class="sub-title-course">COURSE NAME</p>
                    @foreach ($cmCourses as $course)
                    @if ($course->name == 'Beginner')
                    @php
                    $courseUrl = @$course->course_url;

                    $urlParts = explode(config('app_constants.CONTENT'), $courseUrl);
                    $course_slug = count($urlParts) > 1 ? $urlParts[1] : '';

                    @endphp
                        <a href="{{  route('upcomingcourses.list', ['course_slug' => trim($course_slug, '/')])  }}" target="_blank"><p>{{ $course->title }}</p></a>

                        @endif
                    @endforeach
                </div>
                <div class="col-3 course-duration">
                    <p class="sub-title-course">DURATION</p>
                    @foreach ($cmCourses as $course)
                    @if ($course->name == 'Beginner')
                        <p>{{ $course->field_duration_value }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <div class="intermediate-course-container">
        <div class="intermediate-course">
    <img src="{{ asset('/img/course_listing/intermediate_icon.png') }}" alt="intermediate-icon"
    class="intermediate-course-logo">
    @php
    $intermediateCourse = $cmCourses->firstWhere('name', 'Intermediate');
@endphp

@if ($intermediateCourse)
    <h5 class="intermediate-course-title">{{ strtoupper($intermediateCourse->name) }} COURSES</h5>
@endif

</div>
        <div class="row course-level">
            <div class="col-3 course-id">
              <p class="sub-title-course">COURSE ID</p>
              @foreach ($cmCourses as $course)
                    @if ($course->name == 'Intermediate')
                        <p>{{ $course->field_course_id_value }}</p>
                        @endif
                    @endforeach


            </div>
            <div class="col-6 course-name">
                <p class="sub-title-course">COURSE NAME</p>
                @foreach ($cmCourses as $course)
                    @if ($course->name == 'Intermediate')
                    @php
                    $courseUrl = @$course->course_url;

                    $urlParts = explode(config('app_constants.CONTENT'), $courseUrl);
                    $course_slug = count($urlParts) > 1 ? $urlParts[1] : '';

                    @endphp
                        <a href="{{  route('upcomingcourses.list', ['course_slug' => trim($course_slug, '/')])  }}" target="_blank"><p>{{ $course->title }}</p></a>

                        @endif
                    @endforeach

            </div>
            <div class="col-3 course-duration">
             <p class="sub-title-course">DURATION</p>
             @foreach ($cmCourses as $course)
             @if ($course->name == 'Intermediate')
                        <p>{{ $course->field_duration_value }}</p>
                        @endif
                    @endforeach

            </div>
        </div>
    </div>
    <div class="advanced-course-container">
        <div class="advanced-course">
    <img src="{{ asset('/img/course_listing/advanced_icon.png') }}" alt="advanced-icon"
    class="advanced-course-logo">

    @php
    $advancedCourse = $cmCourses->firstWhere('name', 'Advanced');
@endphp

@if ($advancedCourse)
    <h5 class="advanced-course-title">{{ strtoupper($advancedCourse->name) }} COURSES</h5>
@endif
   </div>
        <div class="row course-level">
            <div class="col-3 course-id">
              <p class="sub-title-course">COURSE ID</p>
              @foreach ($cmCourses as $course)
              @if ($course->name == 'Advanced')
                        <p>{{ $course->field_course_id_value  }}</p>
                        @endif
                    @endforeach


            </div>
            <div class="col-6 course-name">
                <p class="sub-title-course">COURSE NAME</p>
                @foreach ($cmCourses as $course)
                @if ($course->name == 'Advanced')
                @php
                $courseUrl = @$course->course_url;

                $urlParts = explode(config('app_constants.CONTENT'), $courseUrl);
                $course_slug = count($urlParts) > 1 ? $urlParts[1] : '';

                @endphp
                    <a href="{{  route('upcomingcourses.list', ['course_slug' => trim($course_slug, '/')])  }}" target="_blank"><p>{{ $course->title }}</p></a>

                        @endif
                    @endforeach

            </div>
            <div class="col-3 course-duration">
             <p class="sub-title-course">DURATION</p>
             @foreach ($cmCourses as $course)
             @if ($course->name == 'Advanced')
                        <p>{{ $course->field_duration_value }}</p>
                        @endif
                    @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
<section id="advertisement-courses-job">
    <div class="row advertisement">
        <div class="col-6 jobs-ad">
           <a href="#"><p class="ad-course">Canada Job Grant ad</p></a>
        </div>
        <div class="col-6 newcomer-ad">
        <a href="#"><p class="ad-course">Newcomers ad</p></a>
        </div>
    </div>
</section>
</body>
@include('layouts.footer')
@endsection
