@extends('layouts.home')

@section('content')

@include('layouts.coursepageheader')
<section id="courses-level-container">
    <div class="courses-level">




        <div class="beginner-course-container">

            @if ($getPMCourses->firstWhere('name', config('app_constants.BEGINNER')))
            <div class="beginner-course mt-5">

                <img src="{{ asset('/img/course_listing/beginner_icon.png') }}" alt="beginner-icon"
                    class="beginner-course-logo">


                @php
                $beginnerCourse = $getPMCourses->firstWhere('name', config('app_constants.BEGINNER'));
                @endphp

                @if ($beginnerCourse)
                <h5 class="beginner-course-title">{{ strtoupper($beginnerCourse->name) }} COURSES</h5>
                @endif

            </div>

            <div class="row course-level">
                <div class="col-3 course-id">
                    <p class="sub-title-course">COURSE ID</p>
                    @foreach ($getPMCourses as $course)
                    @if ($course->name == config('app_constants.BEGINNER'))
                    <p>{{ $course->field_course_id_value }}</p>
                    @endif
                    @endforeach
                </div>
                <div class="col-6 course-name">
                    <p class="sub-title-course">COURSE NAME</p>
                    @foreach ($getPMCourses as $course)
                    @if ($course->name == config('app_constants.BEGINNER'))


                   <a href="{{ route('upcomingcourses.list', ['course_slug' => @$course->course_url]) }}" target="_blank">
                    <p>{{ $course->title }}</p>
                     </a>

                    @endif
                    @endforeach
                </div>
                <div class="col-3 course-duration">
                    <p class="sub-title-course">DURATION</p>
                    @foreach ($getPMCourses as $course)
                    @if ($course->name == config('app_constants.BEGINNER'))
                    <p>{{ $course->field_duration_value }}</p>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>

    </div>


    @if ($getPMCourses->firstWhere('name', config('app_constants.INTERMEDIATE')))
    <div class="intermediate-course-container">
        <div class="intermediate-course mt-5">
            <img src="{{ asset('/img/course_listing/intermediate_icon.png') }}" alt="intermediate-icon"
                class="intermediate-course-logo">
            @php
            $intermediateCourse = $getPMCourses->firstWhere('name', config('app_constants.INTERMEDIATE'));
            @endphp

            @if ($intermediateCourse)
            <h5 class="intermediate-course-title">{{ strtoupper($intermediateCourse->name) }} COURSES</h5>
            @endif

        </div>
        <div class="row course-level">
            <div class="col-3 course-id">
                <p class="sub-title-course">COURSE ID</p>
                @foreach ($getPMCourses as $course)
                @if ($course->name == config('app_constants.INTERMEDIATE'))
                <p>{{ $course->field_course_id_value }}</p>
                @endif
                @endforeach


            </div>
            <div class="col-6 course-name">
                <p class="sub-title-course">COURSE NAME</p>
                @foreach ($getPMCourses as $course)
                @if (is_object($course) && $course->name == config('app_constants.INTERMEDIATE'))

                <a href="{{ route('upcomingcourses.list', ['course_slug' => @$course->course_url]) }}"
                    target="_blank">
                    <p>{{ $course->title }}</p>
                </a>
                @endif
                @endforeach


            </div>

            <div class="col-3 course-duration">
                <p class="sub-title-course">DURATION</p>
                @foreach ($getPMCourses as $course)
                @if ($course->name == config('app_constants.INTERMEDIATE'))
                <p>{{ $course->field_duration_value }}</p>
                @endif
                @endforeach

            </div>
        </div>
    </div>
@endif
@if ($getPMCourses->firstWhere('name', config('app_constants.ADVANCED')))
    <div class="advanced-course-container">
        <div class="advanced-course mt-5">
            <img src="{{ asset('/img/course_listing/advanced_icon.png') }}" alt="advanced-icon"
                class="advanced-course-logo">

            @php
            $advancedCourse = $getPMCourses->firstWhere('name', config('app_constants.ADVANCED'));
            @endphp

            @if ($advancedCourse)
            <h5 class="advanced-course-title">{{ strtoupper($advancedCourse->name) }} COURSES</h5>
            @endif
        </div>
        <div class="row course-level">
            <div class="col-3 course-id">
                <p class="sub-title-course">COURSE ID</p>
                @foreach ($getPMCourses as $course)
                @if ($course->name == config('app_constants.ADVANCED'))
                <p>{{ $course->field_course_id_value }}</p>
                @endif
                @endforeach


            </div>
            <div class="col-6 course-name">
                <p class="sub-title-course">COURSE NAME</p>

                @foreach ($getPMCourses as $course)
                @if ($course->name == config('app_constants.ADVANCED'))

                <a href="{{  route('upcomingcourses.list', ['course_slug' => @$course->course_url])  }}"
                    target="_blank">
                    <p data-url="{{  @$course->nid }}">{{ $course->title }}</p>
                </a>

                @endif
                @endforeach

            </div>
            <div class="col-3 course-duration">
                <p class="sub-title-course">DURATION</p>
                @foreach ($getPMCourses as $course)
                @if ($course->name == config('app_constants.ADVANCED'))
                <p>{{ $course->field_duration_value }}</p>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif
    </div>
</section>
<section id="advertisement-courses-job">
    <div class="row advertisement">
        <div class="col-6 jobs-ad">
            <a href="#">
                <p class="ad-course">Canada Job Grant ad</p>
            </a>
        </div>
        <div class="col-6 newcomer-ad">
            <a href="#">
                <p class="ad-course">Newcomers ad</p>
            </a>
        </div>
    </div>
</section>

@include('layouts.footer')
@endsection
