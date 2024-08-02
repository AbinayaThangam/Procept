@include('layouts.page_nav')
<div class="individualcourse-image-banner-container">
    <div class="individualcourse-image-banner">
        <img src="{{ asset('/img/course_type/' . @$getcoursesTypeImage) }}" alt="Banner Image"
            class="individualcourse-banner-image">
        <div class="overlay individualcourse-text-container">
            <div class="container individualcourse-management">
                <h2 class="mb-3 individualcourse-title">{{ @$trainingDetails->title }}</h2>

            </div>
        </div>
    </div>
</div>