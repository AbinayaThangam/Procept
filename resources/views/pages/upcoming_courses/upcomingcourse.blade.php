@extends('layouts.home')

@section('content')
@include('layouts.nav')

<div class="container py-5">
    <div class="card-header">
        <h4 class="mb-0"><span class="allevents-title">Upcoming</span> Public Sessions</h4>
    </div>
    <button class="all-events-list mt-5">
        <a href="/"> Home </a> <i class='fas'>&#xf0da; </i> Upcoming Public Sessions1
    </button>
    <div class="row justify-content mt-5">
        <div class="col-md-6">
            <form action="{{ route('filterCourses') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="filterdatecourses form-control date_picker" id="start_date"
                        name="start_date" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-5">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control date_picker" id="end_date" name="end_date"
                        value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2">
                    <br>
                    <br>
                    <button type="submit" class="btn event-filter-btn btn-secondary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container table-responsive py-5">
    @php $hasResults = false; @endphp
    @if(isset($upcomingPublicCourse) && $upcomingPublicCourse->count() > 0)
    @foreach ($upcomingPublicCourse as $courseDetails)
    @if (
    $courseDetails->title != 'vacation' &&
    $courseDetails->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title != 'vacation'
    )
    @php $hasResults = true; @endphp
    @break
    @endif
    @endforeach
    @endif

    @if($hasResults)
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
            @foreach ($upcomingPublicCourse as $courseDetails)
            @if ( $courseDetails->title != 'vacation' &&
            $courseDetails->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title != 'vacation')
            <tr>
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
                    @php
                    $courseUrl = @$courseDetails->course_url;
                    $urlParts = explode(config('app_constants.CONTENT'), $courseUrl);
                    $course_slug = count($urlParts) > 1 ? $urlParts[1] : '';
                    @endphp
                    <a href="{{ route('upcomingcourses.list', ['course_slug' => trim($course_slug, '/')]) }}"
                        class="upcoming-courses-course" target="_blank">
                        {{ @$courseDetails->fieldDataFieldCourseNodeDetails->fieldDataFieldCourseNode->title }}
                    </a>
                </td>

                <td>
                    @if ($courseDetails->field_choose_session_type_value ==
                    config('app_constants.SESSION_TYPE_BROKEN_UP'))
                    @for ($i = 1; $i <= 10; $i++) @if (isset($courseDetails["instructor{$i}_url"])) <p>
                        <a href="{{ config('app_constants.PROCEPT_COM'). @$courseDetails[" instructor{$i}_url"] }}"
                            class="upcoming-courses-instructor" target="_blank">
                            {{
                            @$courseDetails["fieldDataFieldInstructor{$i}"]->{"fieldDataFieldInstructorNode{$i}"}->title
                            }}
                        </a>
                        </p>
                        @endif
                        @endfor
                        @else
                        <a href="{{ config('app_constants.PROCEPT_COM') . $courseDetails->fieldCourseInstructor_url }}"
                            class="upcoming-courses-instructor" target="_blank">
                            {{ @$courseDetails->fieldDataFieldCourseInstructor->fieldCourseInstructorNode->title }}
                        </a>
                        @endif
                </td>

                <td>
                    <a href="{{ @$courseDetails->fieldDataFieldResaleNode->fieldDataFieldProceptSellTicketCourse->fieldDataFieldIfYesEventbriteLinkResale->field_if_yes_eventbrite_link_value }}"
                        target="_blank" class="register-here">Register Here</a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    {{ $upcomingPublicCourse->appends(['start_date' => request('start_date'), 'end_date' =>
    request('end_date')])->links() }}
    @else
    <div class="alert alert-info" role="alert">
        No courses found for the selected date range.
    </div>
    @endif
</div>

@include('layouts.footer')
@endsection
