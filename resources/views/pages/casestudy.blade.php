

@extends('layouts.home')
@section('content')
@include('layouts.header')

<div class="row-12 text-left">
    @foreach ($casestudies as $casestudy)
        <div class="content text-left">
        <a href="{{ route('casestudy.show', ['id' => $casestudy->nid, 'url' => $casestudy->url_alias]) }}" target="blank">{{ $casestudy->title }}</a>
        </div>
    @endforeach
</div>

@include('layouts.footer')
@endsection 