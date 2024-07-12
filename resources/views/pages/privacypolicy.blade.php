@extends('layouts.home')

@section('content')
@include('layouts.nav')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            
            <h4><span class="privacypolicy-title">{{ $aboutus->title }}</span></h4>

            <button class="privacypolicy-list"><a href="/"> Home </a> <i class='fas'>&#xf0da;</i> {{ $aboutus->title }}</button>
            <div class="content text-right text-justify-custom mt-3">
                {!! $aboutus->body_value !!}
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
