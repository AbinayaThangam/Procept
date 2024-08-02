@include('layouts.page_nav')
<div class="image-banner-container">
    <div class="training-image-banner">
        <img src="{{ asset('/img/course_type/' . @$getcoursesTypeImage) }}" alt="Banner Image" class="banner-image">


        <div class="overlay training-text-container">
            <div class="container training-management-course">
                <div class="row">
                    <div class="col-12 training-content">
                        <h2 class="mb-3">{{ @$trainingDetails->title }}</h2>
                                   @php
                        $body_value = @$trainingDetails->body_value ?? '';
                        $body_snippet = substr(strip_tags($body_value), 0, 250);
                        $body_length = strlen(strip_tags($body_value));
                        @endphp
                        <p id="body-snippet">{{ $body_snippet }}@if($body_length > 250)...
                            <a id="read-more-btn" href="javascript:void(0);">Read More</a>
                            @endif</p>
                        <div id="full-body" style="display:none;">
                          <p>  {!! $body_value !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
