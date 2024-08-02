@extends('layouts.home')

@section('content')

@include('layouts.coursepageheader')

<section id="courses-level-container">
    <div class="container">
        <div class="courses-level">

            @if ($getBACourses->firstWhere('name', config('app_constants.BEGINNER')))
            @php
            $beginnerCourse = $getBACourses->firstWhere('name', config('app_constants.BEGINNER'));
            $backgroundImage = config('courses.BACKGROUND_IMAGES')[$beginnerCourse->title] ?? 'default_background.jpeg';
            @endphp

            <div class="beginner-course-container mt-5"
                style="background-image: url('{{ asset('/img/course_listing/' . $backgroundImage) }}');">
                <div class="beginner-course">
                    <img src="{{ asset('/img/course_listing/beginner_icon.png') }}" alt="beginner-icon"
                        class="beginner-course-logo img-fluid">
                    <h5 class="beginner-course-title text-center">{{ strtoupper($beginnerCourse->name) }} COURSES</h5>
                </div>

                <div class="row course-level">
                    <div class="col-12">
                        <div class="course-table">
                            <div class="course-header">
                                <div class="course-header-item">COURSE ID</div>
                                <div class="course-header-item">COURSE NAME</div>
                                <div class="course-header-item">DURATION</div>
                            </div>
                            <div class="course-body">
                                @foreach ($getBACourses as $course)
                                @if ($course->name == config('app_constants.BEGINNER'))
                                <div class="course-row">
                                    <div class="course-cell course-id">
                                        <p>{{ $course->field_course_id_value }}</p>
                                    </div>
                                    <div class="course-cell">
                                        <p><a href="{{ route('upcomingcourses.list', ['course_slug' => $course->course_url]) }}"
                                            target="_blank">

                                            {{ $course->title }}
                                        </a></p>
                                    </div>
                                    <div class="course-cell">
                                        <p>{{ $course->field_duration_value }}</p>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($getBACourses->firstWhere('name', config('app_constants.INTERMEDIATE')))
            @php
            $intermediateCourse = $getBACourses->firstWhere('name', config('app_constants.INTERMEDIATE'));
            $backgroundImage = config('courses.BACKGROUND_IMAGES')[$intermediateCourse->title] ??
            'default_background.jpeg';
            @endphp
            <div class="intermediate-course-container mt-5"
                style="background-image: url('{{ asset('/img/course_listing/' . $backgroundImage) }}');">
                <div class="intermediate-course">
                    <img src="{{ asset('/img/course_listing/intermediate_icon.png') }}" alt="intermediate-icon"
                        class="intermediate-course-logo img-fluid">
                    <h5 class="intermediate-course-title text-center">{{ strtoupper($intermediateCourse->name) }}
                        COURSES</h5>
                </div>

                <div class="row course-level">
                    <div class="col-12">
                        <div class="course-table">
                            <div class="course-header">
                                <div class="course-header-item">COURSE ID</div>
                                <div class="course-header-item">COURSE NAME</div>
                                <div class="course-header-item">DURATION</div>
                            </div>
                            <div class="course-body">
                                @foreach ($getBACourses as $course)
                                @if ($course->name == config('app_constants.INTERMEDIATE'))
                                <div class="course-row">
                                    <div class="course-cell course-id">
                                        <p>{{ $course->field_course_id_value }}</p>
                                    </div>
                                    <div class="course-cell">
                                        <p> <a href="{{ route('upcomingcourses.list', ['course_slug' => $course->course_url]) }}"
                                            target="_blank">

                                            {{ $course->title }}
                                        </a></p>
                                    </div>
                                    <div class="course-cell">
                                        <p>{{ $course->field_duration_value }}</p>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if ($getBACourses->firstWhere('name', config('app_constants.ADVANCED')))
            @php
            $advancedCourse = $getBACourses->firstWhere('name', config('app_constants.ADVANCED'));
            $backgroundImage = config('courses.BACKGROUND_IMAGES')[$advancedCourse->title] ?? 'default_background.jpeg';
            @endphp
            <div class="advanced-course-container mt-5"
                style="background-image: url('{{ asset('/img/course_listing/' . $backgroundImage) }}');">
                <div class="advanced-course">
                    <img src="{{ asset('/img/course_listing/advanced_icon.png') }}" alt="advanced-icon"
                        class="advanced-course-logo img-fluid">
                    <h5 class="advanced-course-title text-center">{{ strtoupper($advancedCourse->name) }} COURSES</h5>
                </div>

                <div class="row course-level">
                    <div class="col-12">
                        <div class="course-table">
                            <div class="course-header">
                                <div class="course-header-item">COURSE ID</div>
                                <div class="course-header-item">COURSE NAME</div>
                                <div class="course-header-item">DURATION</div>
                            </div>
                            <div class="course-body">
                                @foreach ($getBACourses as $course)
                                @if ($course->name == config('app_constants.ADVANCED'))
                                <div class="course-row">
                                    <div class="course-cell course-id">
                                        <p>{{ $course->field_course_id_value }}</p>
                                    </div>
                                    <div class="course-cell">
                                        <p> <a href="{{ route('upcomingcourses.list', ['course_slug' => $course->course_url]) }}"
                                            target="_blank">

                                            {{ $course->title }}
                                        </a></p>
                                    </div>
                                    <div class="course-cell">
                                        <p>{{ $course->field_duration_value }}</p>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>

<section id="advertisement-courses-job">
    <div class="container">
        <div class="row advertisement">
            <div class="col-12 col-md-6 mb-3 mb-md-0">
            <a href="{{ route('canada-job-grant') }}" target="_blank"><img src="{{ asset('/img/training_ads/canada_job_ad.png') }}" alt="canada-ad-banner img"
            class="training-ads-banner img-fluid"></a>
            </div>
            <div class="col-12 col-md-6">
                <img src="{{ asset('/img/training_ads/newcomer_gant_ad.png') }}" alt="newcomer-ad-banner img"
                    class="newcomer-ads-banner img-fluid">
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

@endsection
