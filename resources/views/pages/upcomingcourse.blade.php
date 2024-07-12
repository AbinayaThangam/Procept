@extends('layouts.home')

@section('content')
@include('layouts.header')
<h1 class="text-center pt-4">Upcoming Public Courses</h1>
<div class="container table-responsive py-5">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>SESSION DATES</th>
                <th>COURSE</th>
                <th>INSTRUCTOR</th>
                <th>REGISTER</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($upcomingPublicCourse))


            @foreach ($upcomingPublicCourse as $courseDetails)
            @if ($courseDetails->title != 'vacation' &&
            $courseDetails->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title != 'vacation')
            <tr>
                @if ($courseDetails->field_choose_session_type_value ==
                App\Constants\AppConstants::SESSION_TYPE_BROKEN_UP)
                <td>
                    <p>{{ isset($courseDetails->field_start_date1_value) ? date("D, m/d/Y", strtotime($courseDetails->field_start_date1_value)) : '' }}</p>
                    <p>{{ isset($courseDetails->field_start_date2_value) ? date("D, m/d/Y",strtotime($courseDetails->field_start_date2_value)) : '' }}</p>
                    <p>{{ isset($courseDetails->field_start_date3_value) ? date("D, m/d/Y",strtotime($courseDetails->field_start_date3_value)) : '' }}</p>
                    <p>{{ isset($courseDetails->field_start_date4_value) ? date("D, m/d/Y",strtotime($courseDetails->field_start_date4_value)) : '' }}</p>
                    <p>{{ isset($courseDetails->field_start_date5_value) ? date("D, m/d/Y",strtotime($courseDetails->field_start_date5_value)) : '' }}</p>
                    <p>{{ isset($courseDetails->field_start_date6_value) ? date("D, m/d/Y",strtotime($courseDetails->field_start_date6_value)) : '' }}</p>
                    <p>{{ isset($courseDetails->field_start_date7_value) ? date("D, m/d/Y",strtotime($courseDetails->field_start_date7_value)) : '' }}</p>
                    <p>{{ isset($courseDetails->field_start_date8_value) ? date("D, m/d/Y",strtotime($courseDetails->field_start_date8_value)) : '' }}</p>
                    <p>{{ isset($courseDetails->field_start_date9_value) ? date("D, m/d/Y",strtotime($courseDetails->field_start_date9_value)) : '' }}</p>
                    <p>{{ isset($courseDetails->field_start_date10_value) ? date("D, m/d/Y",strtotime($courseDetails->field_start_date10_value)) : '' }}</p>
                </td>
                @else
                <td>
                    {{ isset($courseDetails->field_session_dates_value2) ?
                    date("D, m/d/Y", strtotime($courseDetails->field_session_dates_value)) . ' to ' . date("D, m/d/Y",
                    strtotime($courseDetails->field_session_dates_value2)) :
                    date("D, m/d/Y", strtotime($courseDetails->field_session_dates_value)) }}
                </td>
                @endif

                <td><a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->course_url }}"
                        class="upcoming-courses-course" target="_blank">{{
                        @$courseDetails->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title }}</a></td>

                @if ($courseDetails->field_choose_session_type_value ==
                App\Constants\AppConstants::SESSION_TYPE_BROKEN_UP)
                <td>
                    <p><a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->instructor1_url }}"
                            class="upcoming-courses-instructor" target="_blank">{{
                            @$courseDetails->fieldDataFieldInstructor1->fieldDataFieldInstructorNode1->title }}</a></p>
                    <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->instructor2_url }}"
                        class="upcoming-courses-instructor" target="_blank">
                        <p>{{ @$courseDetails->fieldDataFieldInstructor2->fieldDataFieldInstructorNode2->title }}</p>
                    </a>
                    <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->instructor3_url }}"
                        class="upcoming-courses-instructor" target="_blank">
                        <p>{{ @$courseDetails->fieldDataFieldInstructor3->fieldDataFieldInstructorNode3->title }}</p>
                        <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->instructor4_url }}"
                            class="upcoming-courses-instructor" target="_blank">
                            <p>{{ @$courseDetails->fieldDataFieldInstructor4->fieldDataFieldInstructorNode4->title }}
                            </p>
                        </a>
                        <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->instructor5_url }}"
                            class="upcoming-courses-instructor" target="_blank">
                            <p>{{ @$courseDetails->fieldDataFieldInstructor5->fieldDataFieldInstructorNode5->title }}
                            </p>
                        </a>
                        <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->instructor6_url }}"
                            class="upcoming-courses-instructor" target="_blank">
                            <p>{{ @$courseDetails->fieldDataFieldInstructor6->fieldDataFieldInstructorNode6->title }}
                            </p>
                        </a>
                        <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->instructor7_url }}"
                            class="upcoming-courses-instructor" target="_blank">
                            <p>{{ @$courseDetails->fieldDataFieldInstructor7->fieldDataFieldInstructorNode7->title }}
                            </p>
                        </a>
                        <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->instructor8_url }}"
                            class="upcoming-courses-instructor" target="_blank">
                            <p>{{ @$courseDetails->fieldDataFieldInstructor8->fieldDataFieldInstructorNode8->title }}
                            </p>
                        </a>
                        <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->instructor9_url }}"
                            class="upcoming-courses-instructor" target="_blank">
                            <p>{{ @$courseDetails->fieldDataFieldInstructor9->fieldDataFieldInstructorNode9->title }}
                            </p>
                        </a>
                        <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$courseDetails->instructor10_url }}"
                            class="upcoming-courses-instructor" target="_blank">
                            <p>{{ @$courseDetails->fieldDataFieldInstructor10->fieldDataFieldInstructorNode10->title }}
                            </p>
                        </a>
                </td>
                @else
                <td> <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . $courseDetails->fieldCourseInstructor_url }}"
                        class="upcoming-courses-instructor" target="_blank"> {{
                        @$courseDetails->fieldDataFieldCourseInstructor->fieldCourseInstructorNode->title }}</a></td>
                @endif
                <td><a href="{{ @$courseDetails->fieldDataFieldResaleNode->fieldDataFieldProceptSellTicketCourse->fieldDataFieldIfYesEventbriteLinkResale->field_if_yes_eventbrite_link_value }}"
                        target="_blank" class="register-here">Register Here</a>
                </td>
            </tr>
            @endif
            @endforeach

            @else
            <p>No upcoming courses found.</p>

            @endif
        </tbody>
    </table>
    @if(isset($upcomingPublicCourse))
    {{ $upcomingPublicCourse->links() }}
    @endif
</div>

@include('layouts.footer')
@endsection
