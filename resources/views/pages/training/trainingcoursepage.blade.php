@extends('layouts.home')


@section('content')

@include('layouts.coursepageheader')


<body>
    <section class="courses-level-container">
        <div class="container">
            <div class="courses-level">

                @if ($getcourseslevel->firstWhere('name', config('app_constants.BEGINNER')))
                                @php
                                    $beginnerCourse = $getcourseslevel->firstWhere('name', config('app_constants.BEGINNER'));
                                    $backgroundImage = config('courses.BACKGROUND_IMAGES')[$beginnerCourse->title] ?? 'default_background.jpeg';
                                @endphp

                                <div class="beginner-course-container mt-5"
                                    style="background-image: url('{{ asset('/img/course_listing/' . $backgroundImage) }}');">
                                    <div class="beginner-course">
                                        <img src="{{ asset('/img/course_listing/beginner_icon.png') }}" alt="beginner-icon"
                                            class="beginner-course-logo img-fluid">
                                        <h5 class="beginner-course-title text-center">{{ strtoupper($beginnerCourse->name) }} COURSES
                                        </h5>
                                    </div>


                                    <div class="course-level container-fluid">
                                        <div class="training-course-level">
                                            <div class="row training-courses-title container-fluid">
                                                <div class="course-header-item col-2">COURSE ID</div>
                                                <div class="course-header-item col-7">COURSE NAME</div>
                                                <div class="course-header-item col-3">DURATION</div>
                                            </div>
                                            <div class="row course-body container-fluid mt-2">
                                                @foreach ($getcourseslevel as $course)
                                                    @if ($course->name == config('app_constants.BEGINNER'))

                                                        <div class="col-2 course-id">
                                                            <p>{{ $course->field_course_id_value }}</p>
                                                        </div>
                                                        <div class="col-7 course-title">
                                                            <p> <a href="{{ route('upcomingcourses.list', ['course_slug' => $course->course_url]) }}"
                                                                    target="_blank">

                                                                    {{ $course->title }}
                                                                </a></p>
                                                        </div>
                                                        <div class="col-3 course-duration">
                                                            <p>{{ $course->field_duration_value }}</p>
                                                        </div>

                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                @endif

                @if ($getcourseslevel->firstWhere('name', config('app_constants.INTERMEDIATE')))
                                @php
                                    $intermediateCourse = $getcourseslevel->firstWhere('name', config('app_constants.INTERMEDIATE'));
                                    $backgroundImage = config('courses.BACKGROUND_IMAGES')[$intermediateCourse->title] ??
                                        'default_background.jpeg';
                                @endphp
                                <div class="intermediate-course-container mt-5"
                                    style="background-image: url('{{ asset('/img/course_listing/' . $backgroundImage) }}');">
                                    <div class="intermediate-course">
                                        <img src="{{ asset('/img/course_listing/intermediate_icon.png') }}" alt="intermediate-icon"
                                            class="intermediate-course-logo img-fluid">
                                        <h5 class="intermediate-course-title text-center">
                                            {{ strtoupper($intermediateCourse->name) }}
                                            COURSES
                                        </h5>
                                    </div>

                                    <div class="course-level">
                                        <div class="training-course-level">
                                            <div class="row container-fluid">
                                                <div class="course-header-item col-2">COURSE ID</div>
                                                <div class="course-header-item col-7">COURSE NAME</div>
                                                <div class="course-header-item col-3">DURATION</div>
                                            </div>
                                            <div class="row course-body container-fluid mt-2">
                                                @foreach ($getcourseslevel as $course)
                                                    @if ($course->name == config('app_constants.INTERMEDIATE'))

                                                        <div class="col-2 course-id">
                                                            <p>{{ $course->field_course_id_value }}</p>
                                                        </div>
                                                        <div class="col-7 course-title">
                                                            <p> <a href="{{ route('upcomingcourses.list', ['course_slug' => $course->course_url]) }}"
                                                                    target="_blank">

                                                                    {{ $course->title }}
                                                                </a></p>
                                                        </div>
                                                        <div class="col-3 course-duration">
                                                            <p>{{ $course->field_duration_value }}</p>
                                                        </div>

                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                @endif

                @if ($getcourseslevel->firstWhere('name', config('app_constants.ADVANCED')))
                                @php
                                    $advancedCourse = $getcourseslevel->firstWhere('name', config('app_constants.ADVANCED'));
                                    $backgroundImage = config('courses.BACKGROUND_IMAGES')[$advancedCourse->title] ?? 'default_background.jpeg';
                                @endphp
                                <div class="advanced-course-container mt-5"
                                    style="background-image: url('{{ asset('/img/course_listing/' . $backgroundImage) }}');">
                                    <div class="advanced-course">
                                        <img src="{{ asset('/img/course_listing/advanced_icon.png') }}" alt="advanced-icon"
                                            class="advanced-course-logo img-fluid">
                                        <h5 class="advanced-course-title text-center">{{ strtoupper($advancedCourse->name) }}
                                            COURSES
                                        </h5>
                                    </div>


                                    <div class="course-level container-fluid">
                                        <div class="training-course-level">
                                            <div class="row container-fluid">
                                                <div class="course-header-item col-2">COURSE ID</div>
                                                <div class="course-header-item col-7">COURSE NAME</div>
                                                <div class="course-header-item col-3">DURATION</div>
                                            </div>
                                        </div>
                                        <div class="row course-body container-fluid mt-2">
                                            @foreach ($getcourseslevel as $course)
                                                @if ($course->name == config('app_constants.ADVANCED'))

                                                    <div class="col-2 course-id">
                                                        <p>{{ $course->field_course_id_value }}</p>
                                                    </div>
                                                    <div class="col-7 course-title">
                                                        <p> <a href="{{ route('upcomingcourses.list', ['course_slug' => $course->course_url]) }}"
                                                                target="_blank">

                                                                {{ $course->title }}
                                                            </a></p>
                                                    </div>
                                                    <div class="col-3 course-duration">
                                                        <p>{{ $course->field_duration_value }}</p>
                                                    </div>

                                                @endif
                                            @endforeach
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
                    <img src="{{ asset('/img/training_ads/canada_job_ad.png') }}" alt="canada-ad-banner img"
                        class="training-ads-banner img-fluid">
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('/img/training_ads/newcomer_gant_ad.png') }}" alt="newcomer-ad-banner img"
                        class="newcomer-ads-banner img-fluid">
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
</body>
@endsection