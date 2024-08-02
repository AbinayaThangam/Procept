@extends('layouts.home')

@section('content')
    @include('layouts.nav')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12">

                <h4><span class="allevents-title">{{ @$payingUsPage->title }}</span></h4>
                <button class="all-events-list mt-3">
                    <a href="/">Home</a> <i class='fas'>&#xf0da;</i> {{ @$payingUsPage->title }}
                </button>

                <div class="paying-us-page">
                    <div class="content text-right text-justify-custom mt-3">
                        {!! $payingUsPage->body_value !!}

                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
