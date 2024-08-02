@extends('layouts.home')

@section('content')
@include('layouts.individualcourseheader')


<section id="section-upcoming-courses-page">
    <div class="container-fluid">
        <div class="row d-flex justify-content-end gap-5">
            <div class="upcoming-courses-list col-12 col-md-7">
                <div class="upcoming-courses-content">
                    <p>{!! @$courseData->field_abstract_value !!}</p>
                </div>
            </div>

            <div class="upcoming-courses-list-fullleft col-12 col-md-4 mt-0">

                @if (count($testimonialsData) > 0)

                            <div class="upcoming-courses-content-left">

                                <div id="testimonial_carousel" class="testimonial-carousel">
                                    <div class="container testimonial-container">
                                        <h6 class="upcoming-courses-testimonials-title">TESTIMONIALS</h6>
                                        <ul class="upcoming-testimonial-list">
                                            @foreach ($testimonialsData as $testimonial)
                                                                        <li>
                                                                            <div class="upcoming-testimonial-content">
                                                                                <span class="testimonial-content"><p>"{!! strip_tags($testimonial->FieldDataBodyCourse->body_value) !!}"</span></p>

                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <p>
                                                                                           @php
                                                                                            $testimonialImage = @$testimonial->FieldDataFieldTestimonialImage->FileManagedTestimonialImage->uri;
                                                                                            if ($testimonialImage) {
                                                                                                $pathParts = explode(config('app_constants.PUBLIC_FOLDER'), $testimonialImage);
                                                                                                $relativePath = isset($pathParts[1]) ? $pathParts[1] : $testimonialImage;
                                                                                                $imageUrl = config('app_constants.FILE_FOLDER') . '/' . $relativePath;
                                                                                            } else {
                                                                                                $imageUrl = asset('/img/upcoming_public_courses/user.jpg');
                                                                                            }
                                                                                        @endphp
                                                                                        <img src="{{ $imageUrl }}" alt="Testimonial Image" class="testimonial-img">

                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <p class="testimoinals-title-text">{{ @$testimonial->title }}</p>
                                                                                        
                                                                                        <p class="position-text">
                                                                                            {{ @$testimonial->FieldDataFieldTestimonialPositionNode->field_testimonial_position_value }}
                                                                                        </p>
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
                        @if(@$courseData->field_brochure_link_value)
                        <div class="brochure-details">
                            <a href="{{ @$courseData->field_brochure_link_value }}" target="_blank"><img
                                    src="{{asset('/img/upcoming_public_courses/brochure_button.png')}}"
                                    class="brochue-more-img" alt="learn-icon"></a>
                        </div>
                        @endif

                        @if(isset($videolinkiframe) && !empty($videolinkiframe))
                        <div id="video-container">
                            <h3 class="video-title mt-5">VIDEO TESTIMONIALS</h3>
                        
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


                        <div class="upcoming-courses-sessions">
                            <h6 class="upcoming-courses-sessions-title">UPCOMING SESSIONS</h6>

                            @if (!empty($upcomingSessionData) && count($upcomingSessionData) > 0)

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
                                        Instructor(s):
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
                                        <b>Starts in {{ $daysUntilSession }} days</b><br>
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
                                <a href="{{ route('upcomingcourses.sessions.list', ['course_title_slug' => $relativeUrlAfterSegmentURL]) }}"
                                    target="_blank">
                                    <img src="{{ asset('/img/upcoming_public_courses/view_all_button.png') }}"
                                        class="session-all-img" alt="learn-icon">
                                </a>
                            </div>

                            @else
                            <p>Sessions not found.</p>
                            @endif
                        </div>


                          @if (@$courseData->field_pdu_value)
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
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>

</section>

@include('layouts.footer')
@endsection
