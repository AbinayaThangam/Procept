
@include('layouts.page_nav')
<div class="image-banner-container">
    <div class="training-image-banner">
        <img src="{{ asset('/img/course_type/project_management_701417940.jpeg') }}" alt="Banner Image" class="banner-image">
        <div class="overlay training-text-container">
            <div class="container training-management-course">
                <div class="row">
                    <div class="col-12 training-content">
                        <h2 class="mb-3">{{ $trainingDetails->title }}</h2>
                        <p> {!! $trainingDetails->body_value !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
