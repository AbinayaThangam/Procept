@extends('layouts.home')

@section('content')
@include('layouts.nav')
<style>
  
</style>
<div class="container">
    <div class="row mb-4">
        <div class="col-12 text-justify">
            <h4 class="search-filter-course-title mt-5">{{$filterdescription->title}}</h4>
            <button class="all-events-list mt-3"><a href="/"> Home </a> <i class='fas'>&#xf0da; </i> View Course Details
            </button>
            <div class="content search-filter-course mt-5">
                {!! $filterdescription->field_abstract_value !!}
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
