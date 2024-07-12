@extends('layouts.home')

@section('content')
@include('layouts.header')


    <div class="row-12 text-left">
        <h2>{{ $aboutus->title }}</h2>
        <div class="content text-left">
            {!! $aboutus->body_value !!}
        </div>
    </div>
    @include('layouts.footer')
    @endsection