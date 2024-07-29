<div class="video-banner-container">
    <div class="video-banner">
        <video autoplay muted loop  class="video-height">
            <source src="{{asset('/img/4426529-uhd_3840_2160_25fps.mp4')}}" type="video/mp4" class="d-block w-100">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="container main-content search-filter home-search-box mt-12">
        <div class="search-bar mt-8">
            <div class="row g-1 py-5">
                <div class="search-container">
                    <div class="col-md-10 d-flex home-search-box">
                        <input placeholder="What do you want to learn?" class="form-control border-0 search-courses">
                        <img src="{{ asset('/img/search_and_video/Seach icon.png') }}" alt="search-icon"
                            class="img-fluid search-icon search-courses" style="">
                    </div>
                    <div class="filter-courses-container" style="display: none;">
                        <div id="filter-courses-container" class="container" style="display: none;">
                            <ul id="filter-courses-list" class="list-unstyled" style="display: none;">

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="menu-list menu-list-content">
                    <div class="row">
                        <div class="col-3 search-bar-menu-list first-element">
                            <h5 class="mb-0">1+ million trained </h5>
                            <span class="menu-info-link"> |</span>
                        </div>

                        <div class="col-3 search-bar-menu-list">
                            <h5 class="mb-0">17,000+ clients </h5>
                            <span class="menu-info-link"> |</span>
                        </div>
                        <div class="col-3 search-bar-menu-list">
                            <h5 class="mb-0">70+ instructors </h5>
                            <span class="menu-info-link"> |</span>
                        </div>
                        <div class="col-3 search-bar-menu-list">
                            <h5 class="mb-0">300+ courses</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="course-navigation d-none">
            <input type="hidden" id="selected-nid">

            <a href="" id="course-summary">
            </a>

        </div>
    </div>
</div>

