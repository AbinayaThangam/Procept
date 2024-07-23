@extends('layouts.home')
@section('content')
@include('layouts.nav')

<div class="container my-5">
    <div class="card-header">
        <h4 class="mb-0"><span class="allevents-title">View All </span> Company News</h4>
    </div>
    <button class="all-events-list mt-5">
        <a href="/"> Home </a> <i class='fas'>&#xf0da; </i> View All Comapny News
    </button>
    <div class="row">
        <div class="col-md-2">
            <div class="company-news-list">
                @foreach ($allCompanyNews as $item)
                    @if ($item->filename != '')
                        <p>
                            <a href="{{ config('app_constants.PROCEPT_COM') . $item->url }}" target="_blank">
                            <img src="{{ config('app_constants.FILE_FOLDER') . '/' . $item->filename }}" class="menu-news-img mt-4">
                            </a>
                        </p>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-10 mt-4">

            @foreach ($allCompanyNews as $item)
                <div class="company-news-list mb-4">
                    <a href="{{ \App\Constants\AppConstants::PROCEPT_COM . @$item->url }}" target="_blank"
                        class="company-news-title">
                        <h4 class="title-part-2">{{ $item->title ?? '' }}
                    </a></h4>

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
