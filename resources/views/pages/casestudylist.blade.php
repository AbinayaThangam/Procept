@extends('layouts.home')

@section('content')
@include('layouts.header')

<body>
    <div class="row-12 text-left">
        @foreach ($case as $cases)


            <div class="content text-left">
                {!! $cases->body_value !!}
            </div>
        @endforeach
    </div>
    @include('layouts.footer')
    @endsection