
@extends('layouts.home')

@section('content')
    @include('layouts.nav')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h4><span class="allevents-title">{{@$getTeamPage->title}}</span></h4>
                <button class="all-events-list mt-3">
                    <a href="/">Home</a> <i class='fas'>&#xf0da;</i> {{@$getTeamPage->title}}
                </button>
                <div class="content text-right text-justify-custom mt-3">
                    <h6>{{@$getTeamPage->field_credentials_value}}</span></h6>
                    <img class="team-image"
                    src="{{ config('app_constants.FILE_FOLDER') . '/' . @$getTeamPage->filename }}"
                      alt="">
                    {!! @$getTeamPage->field_team_summary_value !!}
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
