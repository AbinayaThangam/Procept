@extends('layouts.home')

@section('content')
@include('layouts.pageheader')


<section id="section-upcoming-courses-page">
    <div class="container-fluid">
        <div class="row d-flex">
            <div class="upcoming-courses-list col-12 col-md-1"></div>
            <div class="upcoming-courses-list col-12 col-md-7">
                <div class="upcoming-courses-content">
                    <p>{!! @$courseData->field_abstract_value !!}</p>
                </div>
            </div>

            <div class="upcoming-courses-list-fullleft col-12 col-md-4 mt-0">

                @if (count($testimonialsData) > 0 || (!empty($testimonialsData)))

                <div class="upcoming-courses-content-left">

                    <div id="testimonial_carousel" class="testimonial-carousel">
                        <div class="container testimonial-container">
                            <h6 class="upcoming-courses-testimonials-title">TESTIMONIALS
                                </h6>
                            <ul class="upcoming-testimonial-list">
                                @foreach ($testimonialsData as $testimonial)
                                <li>
                                    <div class="upcoming-testimonial-content">
                                        <p>{!! @$testimonial->FieldDataBodyCourse->body_value !!}</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>
                                                    @if(empty(@$testimonial->FieldDataFieldTestimonialImage->FileManagedTestimonialImage->filename))
                                                    <img src="{{ asset('/img/upcoming_public_courses/user.jpg') }}"
                                                        alt="Testimonial Image" class="testimonial-img">
                                                    @else

                                                    <img src="{{ config('app_constants.FILE_FOLDER') . '/' . @$testimonial->FieldDataFieldTestimonialImage->FileManagedTestimonialImage->filename }}"
                                                        alt="Testimonial Image" class="testimonial-img">
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="position-text">{{
                                                    @$testimonial->FieldDataFieldTestimonialPositionNode->field_testimonial_position_value
                                                    }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <div class="dots-container"></div>
                        </div>
                    </div>

                </div>
                @endif

                <div class="upcoming-courses-content-info">
                    <div class="upcoming-testimonial-courses-info">

                        <h6 class="courses-info-title">COURSE INFO</h6>
                        <div class="course-info-content">
                            <p> Course ID: {{ @$courseData->fieldDataFieldCourseId->field_course_id_value }}</p>
                            <p> Course Level: {{ @$courseData->name }}</p>
                            <p> Duration: {{ @$courseData->fieldDataFieldDuration->field_duration_value }}</p>
                        </div>
                        <div class="brochure-details">
                            <a href="{{ @$courseData->field_brochure_link_value }}" target="_blank"><img
                                    src="{{asset('/img/upcoming_public_courses/brochure_button.png')}}"
                                    class="brochue-more-img" alt="learn-icon"></a>
                        </div>
                      @if(isset($videolinkiframe) && !empty($videolinkiframe))
                            <div id="video-container">
                                <h3 class="video-title mt-5">VIDEO TESTIMONIALS</h3>
                                <a href="#"><span class="testimonial-btn">View all ></span></a>
                                @foreach($videolinkiframe as $src)
                                    <div class="video-wrapper">
                                        <iframe class="video-frame" width="360" height="215" src="{{ $src }}" frameborder="0"
                                            allow="autoplay clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    </div>
                                @endforeach
                            </div>
                            <div id="dots-container">

                            </div>

                        @endif

                        @if (count($upcomingSessionData) > 0 || (!empty($upcomingSessionData)))

                        <div class="upcoming-courses-sessions">
                            <h6 class="upcoming-courses-sessions-title">UPCOMING SESSIONS</h6>
                            @foreach ($upcomingSessionData as $sessionData)

                            <div class="row">
                                <div class="col-md-6 upcoming-session-img">
                                    @if ($sessionData->field_online_value == config('app_constants.LOCATION_ONLINE'))
                                    <p>
                                        <img src="{{ asset('/img/upcoming_public_courses/online_course_icon.png') }}"
                                            alt="online_course_icon">
                                    </p>
                                    @elseif ($sessionData->field_online_value ==
                                    config('app_constants.LOCATION_INPERSON'))
                                    <p>
                                        <img src="{{ asset('/img/upcoming_public_courses/in_person_course_icon.png') }}"
                                            alt="in_person_course_icon">
                                    </p>
                                    @endif
                                </div>


                                <div class="col-md-6">
                                    @php
                                    $sessionDate = $sessionData->field_session_dates_value
                                    ? \Carbon\Carbon::parse($sessionData->field_session_dates_value)
                                    : \Carbon\Carbon::parse($sessionData->field_start_date1_value);


                                    $formattedSessionDate = $sessionDate->format('F j, Y');

                                    $daysUntilSession = $sessionDate->diffInDays(\Carbon\Carbon::now());
                                    @endphp
                                    <p>
                                        Begins {{ $formattedSessionDate }}<br>
                                        Instructor(S):
                                        @if(isset($sessionData->fieldDataFieldCourseInstructor->fieldCourseInstructorNode->title))
                                        {{
                                        $sessionData->fieldDataFieldCourseInstructor->fieldCourseInstructorNode->title
                                        }}
                                        @elseif(isset($sessionData->fieldDataFieldInstructor1->fieldDataFieldInstructorNode1->title))
                                        {{ $sessionData->fieldDataFieldInstructor1->fieldDataFieldInstructorNode1->title
                                        }}
                                        @else
                                        Not Available
                                        @endif<br>
                                        <b>Starts in {{ $daysUntilSession }} days</b> <br>
                                        <a href="{{ @$sessionData->field_if_yes_eventbrite_link_value }}"
                                            target="_blank" class="course-register">Register ></a>
                                    </p>
                                </div>

                            </div>
                            @endforeach
                            @php
                                    $currentUrl = url()->current();
                                    $decodedUrl = urldecode($currentUrl);
                                    $baseUrl = url()->to('/');
                                    $relativeUrl = str()->after($decodedUrl, $baseUrl);
                                    $segment = config('app_constants.COURSES') . '/';
                                    $relativeUrlAfterSegmentURL = str()->after($relativeUrl, $segment);

                                @endphp

                            <div class="session-button-details">
                                <a href="{{ route('upcomingcourses.sessions.list',['course_title_slug'=>$relativeUrlAfterSegmentURL]) }}"
                                    target="_blank"><img
                                        src="{{asset('/img/upcoming_public_courses/view_all_button.png')}}"
                                        class="session-all-img" alt="learn-icon"></a>
                            </div>
                        </div>


                        @endif

                        <div class="pmi-pdu-breakdown mt-4">
                            <h6 class="pmi-pdu-breakdown-title">PMI PDU BREAKDOWN</h6>
                            <div class="pmi-pdu-breakdown-content">
                                @php
                                $content = $courseData->field_pdu_value ?? '';
                                $baseUrl = config('app_constants.TRAINING_URL');


                                $updatedContent = preg_replace_callback(
                                '/<img\s+[^>]*src="([^"]*)"/i',
                                    function ($matches) use ($baseUrl) {
                                    $src = $matches[1];
                                    if (!preg_match('/^https?:\/\//i', $src)) {
                                    $src = $baseUrl . ltrim($src, '/');
                                    }
                                    return str_replace($matches[1], $src, $matches[0]);
                                    },
                                    $content
                                    );


                                    $updatedContent = str_replace(
                                    config('app_constants.VIEW_ALL_CREDIT'),
                                    '<img src="' . asset('/img/upcoming_public_courses/all_credits_button.png') . '"
                                        class="all-credits-img" alt="learn-icon">',
                                    $updatedContent
                                    );
                                    @endphp

                                    <p>{!! $updatedContent !!}</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>

</section>

@include('layouts.footer')
@endsection
