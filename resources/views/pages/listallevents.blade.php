@extends('layouts.home')

@section('content')
@include('layouts.nav')

<div class="container event-all-list mt-5">
    <div class="row mt-5">
        <div class="col-md-12">

            <div class="card-header">
                <h4 class="mb-0"><span class="allevents-title">View </span>All Events</h4>
            </div>
            <button class="all-events-list mt-5">
                <a href="/"> Home </a> <i class='fas'>&#xf0da; </i> View All Events
            </button>
            <div class="container py-5">
                <div class="row justify-content">
                    <div class="col-md-6">
                        <form action="{{ route('filterevents') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-5">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="filterevents form-control date_picker" id="start_date" name="start_date"
                                    value="{{ request('start_date') }}">
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
            <div class="card-body mt-5">
                @if($listallevents->isEmpty())
                    <div class="alert alert-info" role="alert">
                        No events found for the selected date range.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Event Date</th>
                                </tr>
                            </thead>
                            <tbody id="events-table-body">
                                @foreach ($listallevents as $event)
                                    <tr>
                                        <td>
                                            @if (@$event->url)
                                            <a href="{{ route('showevents', ['events_slug' => @$event->url]) }}"
                                                target="_blank"
                                                class="text-decoration-none list-all-events">{{ $event->title }}</a>
                                            @else
                                            {{ $event->title }}
                                            @endif


                                        </td>
                                        <td>{{ $event->formatted_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
