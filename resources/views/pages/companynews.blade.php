@extends('layouts.home')
@section('content')
@include('layouts.header')

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Company News</h2>
            @foreach ($allCompanyNews as $item)
            <div class="company-news-list mb-4">
                <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$item->url }}" target="_blank"
                    class="company-news-title">
                    <h4 class="title-part-2">{{ $item->title ?? '' }}</h4>
                </a>
                <div class="company-news-body-summary">
                    @if ($item->fieldDataBody->body_summary)
                    @if (strlen($item->fieldDataBody->body_summary) >= 250)
                    <span class="short-text">
                        {!! substr($item->fieldDataBody->body_summary, 0, 250) !!}...</span>
                    <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . $item->url }}" target="_blank"
                        class="company-list-see-more">See more</a>
                    @else
                    {!! $item->fieldDataBody->body_summary !!}
                    @endif
                    @else
                    @if (strlen($item->fieldDataBody->body_value) >= 250)
                    <span class="short-text">
                        {!! substr($item->fieldDataBody->body_value, 0, 250) !!}...</span>
                    <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . $item->url }}" target="_blank"
                        class="company-list-see-more">See more</a>
                    @else
                    {!! $item->fieldDataBody->body_value !!}
                    @endif
                    @endif


                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{$allCompanyNews->links() }}
</div>

@include('layouts.footer')
@endsection
