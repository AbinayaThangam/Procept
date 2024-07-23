@extends('layouts.home')

@section('content')
@include('layouts.nav')

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
                <th>SESSION DATES</th>
                <th>INSTRUCTOR</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courseSessionsData as $courseDetails)

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

                    @if ($courseDetails->field_choose_session_type_value ==
                    config('app_constants.SESSION_TYPE_BROKEN_UP'))

                    @for ($i = 1; $i <= 10; $i++) <p>
                        <a href="{{ config('app_constants.PROCEPT_COM'). @$courseDetails[" instructor{$i}_url"] }}"
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

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@include('layouts.footer')
@endsection
