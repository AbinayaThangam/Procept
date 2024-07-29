@extends('layouts.home')

@section('content')
@include('layouts.nav')
@include('layouts.header')
<section id="section-graphical" class="container">
    <div class="content-graphical">
        <div class="row justify-content-between">
            <div class="col-md-4 graphical-content-menu mb-4">
                <div class="content-menu-title">
                    <div class="icon-box">
                        <div class="training-link py-4">
                            <a href="{{ config('app_constants.TRAINING_URL') }}" target="_blank"><img
                                    src="{{asset('/img/services_image/Consulting Icon.png')}}" alt="one1"></a>
                        </div>
                        <a href="{{  config('app_constants.TRAINING_URL')  }}" target="_blank">
                            <h6>PROJECT MANAGEMENT</h6>
                        </a>
                    </div>
                    <div class="content-menu-subcontent">
                        <p>Discover our trained training approach, extensive course catalog, and credit earning
                            opportunities to advance your career. Start your learning journey with us today!</p>
                    </div>
                    <div class="content-menu-btn">
                        <a href="{{  route('training.pmcourses.page')  }}" target="_blank"> <img
                                src="{{asset('/img/services_image/Orange Learn More Button.png')}}"
                                alt="learn-icon"></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 graphical-content-menu mb-4">
                <div class="content-menu-title">
                    <div class="training-link py-4">
                        <a href="{{ config('app_constants.PROCEPT_COM')}}" target="_blank"> <img
                                src="{{asset('/img/services_image/Consulting Icon.png')}}" alt="consulting-icon"></a>
                    </div>
                    <a href="{{  config('app_constants.PROCEPT_COM') }}" target="_blank">
                        <h6>CHANGE MANAGEMENT</h6>
                    </a>
                    <div class="content-menu-subcontent">
                        <p>Unlock success with our consulting services. Benefits from expert advisory support and
                            explore our detailed case studies. Partner with us to achieve your business goals.</p>
                    </div>
                    <div class="content-menu-btn">
                        <a href="{{ route('training.cmcourses.page') }}" target="_blank"> <img
                                src="{{asset('/img/services_image/Blue Learn More Button.png')}}" alt="learn-icon"></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 graphical-content-menu mb-4">
                <div class="content-menu-title">
                    <div class="training-link py-4">
                        <a href="{{ config('app_constants.PROCEPT_COM')}}" target="_blank"> <img
                                src="{{asset('/img/services_image/Consulting Icon.png')}}" alt="one1"></a>
                    </div>
                    <a href="{{  config('app_constants.PROCEPT_COM') }}" target="_blank">
                        <h6>Business & Data Analysis</h6>
                    </a>
                    <div class="content-menu-subcontent">
                        <p>Discover who we are, meet our dedicated management team and expert trainers, and learn about
                            our valued partners. Join us and thrive together.</p>
                    </div>
                    <div class="content-menu-btn about-us-content-menu-btn">
                        <a href="{{ route('training.bacourses.page') }}" target="_blank"> <img
                                src="{{asset('/img/services_image/Green Learn More Button.png')}}" alt="learn-icon"></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 graphical-content-menu mb-4">
                <div class="content-menu-title">
                    <div class="training-link py-4">
                        <a href="{{ config('app_constants.PROCEPT_COM')}}" target="_blank"> <img
                                src="{{asset('/img/services_image/Consulting Icon.png')}}" alt="one1"></a>
                    </div>
                    <a href="{{  config('app_constants.PROCEPT_COM') }}" target="_blank">
                        <h6>Leadership Courses</h6>
                    </a>
                    <div class="content-menu-subcontent">
                        <p>Discover who we are, meet our dedicated management team and expert trainers, and learn about
                            our valued partners. Join us and thrive together.</p>
                    </div>
                    <div class="content-menu-btn about-us-content-menu-btn">
                        <a href="{{ route('training.leadershipcourses.page') }}" target="_blank"> <img
                                src="{{asset('/img/services_image/Green Learn More Button.png')}}" alt="learn-icon"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





@include('layouts.footer')
@endsection
