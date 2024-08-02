@extends('layouts.home')

@section('content')
@include('layouts.page_nav')

<div class="container py-5">
    <div class="card-header">
        <h4 class="mb-0">{{ @$courseTitleData->title }}</h4>
    </div>
    <button class="all-events-list mt-5">
        <a href="/"> Home </a> <i class='fas'>&#xf0da; </i> <a href="{{ route('upcoming.public.course.list') }}"> Upcoming Public Sessions </a>
        <i class='fas'>&#xf0da; </i>   {{ @$courseTitleData->title }}
    </button>
</div>

<div class="container table-responsive py-5">

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Online / In Person</th>
                <th>SESSION DATES</th>
                <th>INSTRUCTOR</th>
                <th>REGISTER</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courseSessionsData as $courseDetails)

            <tr>
                <td>

                        @php
                            $field_online_value = '';
                            $course_icon = '';
                            $location_title = '';

                            $online_value = @$courseDetails->FieldDataFieldSessionLocLocation->fieldDataFieldOnline->field_online_value;

                            if ($online_value == config('app_constants.LOCATION_ONLINE')) {
                                $field_online_value = 'Online';
                                $course_icon = '/img/upcoming_public_courses/online_course_icon.png';
                            } elseif ($online_value == config('app_constants.LOCATION_INPERON')) {
                                $field_online_value = 'In Person';
                                $course_icon = '/img/upcoming_public_courses/in_person_course_icon.png';
                                $location_title = @$courseDetails->FieldDataFieldSessionLocLocation->fieldDataFieldSessionLocation->FieldDataFieldSessionLocationNode->title;
                            }
                        @endphp

                        <div class="upcoming-session-course-info">
                            @if ($course_icon)
                                <p class="course-icon">
                                    <img src="{{ asset($course_icon) }}" alt="{{ $field_online_value }}_course_icon" class="online_location_image">
                                </p>
                            @endif

                            <span class="upcoming-session-course-type">{{ $field_online_value }}</span>

                            @if ($location_title)
                                <span class="location-title">({{ $location_title }})</span>
                            @endif
                        </div>


                </td>
                @if ( $courseDetails->field_choose_session_type_value == config('app_constants.SESSION_TYPE_BROKEN_UP'))
                <td>

                    @for ($i = 1; $i <= 10; $i++) @if (isset($courseDetails["field_start_date{$i}_value"])) <p>{{
                        date("D, m/d/Y", strtotime($courseDetails["field_start_date{$i}_value"])) }}</p>
                        @endif
                        @endfor
                </td>
                @else
                <td>
                    {{ isset($courseDetails->field_session_dates_value2) ?
                    date("D, m/d/Y", strtotime($courseDetails->field_session_dates_value)) . ' to ' . date(
                    "D, m/d/Y",
                    strtotime($courseDetails->field_session_dates_value2)
                    ) :
                    date("D, m/d/Y", strtotime($courseDetails->field_session_dates_value)) }}
                </td>
                @endif
                <td>

                    @if ($courseDetails->field_choose_session_type_value ==
                    config('app_constants.SESSION_TYPE_BROKEN_UP'))

                    @for ($i = 1; $i <= 10; $i++) <p>
                        <a href="{{ config('app_constants.PROCEPT_COM'). @$courseDetails["instructor{$i}_url"] }}"
                            class="upcoming-courses-instructor" target="_blank">

                            {{
                            @$courseDetails["fieldDataFieldInstructor{$i}"]->{"fieldDataFieldInstructorNode{$i}"}->title
                            }}
                        </a>
                        </p>

                        @endfor
                        @else
                        <a href="{{ config('app_constants.PROCEPT_COM') . $courseDetails->fieldCourseInstructor_url }}"
                            class="upcoming-courses-instructor" target="_blank">
                            {{ @$courseDetails->fieldDataFieldCourseInstructor->fieldCourseInstructorNode->title }}
                        </a>
                        @endif
                </td>



           <td>
            <a href="{{ @$courseDetails->field_if_yes_eventbrite_link_value }}" class="upcoming-courses-instructor" target="_blank">
              Register
            </a>

            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $courseSessionsData->links() }}

</div>

@include('layouts.footer')
@endsection
