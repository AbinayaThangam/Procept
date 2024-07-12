@extends('layouts.home')

@section('content')
@include('layouts.nav')

<div class="container event-all-list mt-5">
    <div class="row mt-5">
        <div class="col-md-12">

            <div class="card-header mt-5">
                <h4 class="mb-0"><span class="allevents-title">View </span>All Events</h4>
            </div>
            <button class="all-events-list">
                <a href="/"> Home </a> <i class='fas'>&#xf0da; </i> View All Events
            </button>
            <div class="filter-event-date mt-3">
                <div class="row">
                    <div class="filter-event-start col-3">
                        <label for="start-date">Start Date</label>
                        <input type="date" id="start-date" name="start-date">
                    </div>
                    <div class="filter-event-end col-3">
                        <label for="end-date">End Date</label>
                        <input type="date" id="end-date" name="end-date">
                    </div>
                    <div class="filter-event-btn col-6">
                        <button class="event-date-submit" type="button" id="submit-btn">SUBMIT</button>
                    </div>
                </div>
            </div>
            <div class="card-body mt-5">
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
                                        <a href="{{ route('showevents', ['id' => $event->nid, 'url' => $event->url]) }}"
                                            target="_blank"
                                            class="text-decoration-none list-all-events">{{ $event->title }}</a>
                                    </td>
                                    <td>{{ $event->formatted_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')
@endsection