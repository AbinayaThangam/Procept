@extends('layouts.home')

@section('content')

<header class="header-container top-header py-3 justify-content-between">
    <div class="row">
        <div class="col-2 m-auto">
            <a class="navbar-brand" href="{{ config('app_constants.PROCEPT_COM')}}" target="_blank">
                <img src="{{ asset('/img/header_image/Procept Logo.png') }}" alt="Logo" width="260" height="80">
            </a>
        </div>

        <div class="col-6 top-menu-bar justify-content-center align-items-center m-auto">
            @foreach($menuBarDetails as $menu)
            <div class="container">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="{{ $menu['url'] ?? '#' }}" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false" @if (!empty($menu['url'])) target="_blank"
                        @endif>
                        {{ $menu['title'] }}
                    </a>
                    @if(!empty($menu['submenus']))
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        @foreach($menu['submenus'] as $submenu)
                        <li class="dropdown-submenu">
                            <a class="dropdown-item {{ !empty($submenu['submenus']) ? 'dropdown-toggle' : '' }}"
                                href="{{ $submenu['url'] ?? '#' }}" @if (!empty($submenu['url'])) target="_blank"
                                @endif>
                                {{ $submenu['title'] }}
                            </a>
                            @if(!empty($submenu['submenus']))
                            <ul class="dropdown-menu">
                                @foreach($submenu['submenus'] as $subsubmenu)
                                <li>
                                    <a class="dropdown-item" href="{{ $subsubmenu['url'] ?? '#' }}" @if
                                        (!empty($subsubmenu['url'])) target="_blank" @endif>
                                        {{ $subsubmenu['title'] }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            @endforeach

            <a href="{{ route('contact.show')}}" class="nav-link" target="_blank">Contact</a>

        </div>

        <div class="col-3  flex justify-content-end d-flex row  align-items-center">
            <div class="training-contact-info align-items-center ">
                <div class="phone-number m-auto">
                    <a href="tel:1-800-261-6861" class="contact-info-link">1-800-261-6861</a>
                </div>
                <div class="phone-number m-auto">
                    <a class="contact-info-link"> |</a>
                </div>
                <div class="mail-logo m-auto">
                    <a href="mailto:info@procept.com" class="contact-info-link">info@procept.com</a>
                </div>
            </div>
        </div>

        <div class="col-1 justify-content-center align-items-center m-auto">
            <div class="training-social-links text-center ">
                <div class="social-icons  justify-content-around d-flex">
                    <a href="https://www.youtube.com/channel/UCtI42RRQ_3lpI8t2Ah1Zthw" target="_blank">
                        <img src="{{ asset('/img/header_image/Social Media YouTube icon.png') }}" alt="YouTube Icon"
                            width="24" height="50">
                    </a>
                    <a href="https://www.linkedin.com/company/121609/ " target="_blank">
                        <img src="{{ asset('/img/header_image/Social Media LinkedIn icon.png') }}" alt="LinkedIn Icon"
                            width="16" height="50">
                    </a>



                    <a href="{{ route('rss.feed') }}" target="_blank">

                        <img src="{{ asset('/img/header_image/Social Media RSS icon.png') }}" alt="RSS Icon" width="16"
                            height="30">
                    </a>
                </div>
            </div>
        </div>
        <div class="course-level search-container">
            <div class="col-md-10 d-flex training-search-box">
                <input placeholder="Search" class="form-control border-0 search-courses">
                <img src="{{ asset('/img/search_and_video/Seach icon.png') }}" alt="search-icon"
                    class="img-fluid training-search-icon search-courses" style="">
            </div>
            <div class="filter-courses-container" style="display: none;">
                <div id="filter-courses-container" class="container" style="display: none;">
                    <ul id="filter-courses-list" class="list-unstyled" style="display: none;">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="message-bar justify-content-center align-items-center">
    <marquee>
        @foreach ($promotionalMessageBar as $promotional)
        @if (!empty($promotional->url))
        <a href="{{ $promotional->url }}" class="message-link" target="_blank">
            <p style="display:inline;" class="message-text">{{ $promotional->message }} </p>
        </a>
        @else
        <p style="display:inline;">{{ $promotional->message }}</p>
        @endif
        @endforeach
    </marquee>
</div>

<div class="video-banner-container">
    <div class="training-video-banner">
        <video autoplay muted loop class="video-height">
            <source src="{{asset('/img/4426529-uhd_3840_2160_25fps.mp4')}}" type="video/mp4" class="d-block w-100">
            Your browser does not support the video tag.
        </video>
        <div class="overlay training-text-container">
            <div class="container training-management-course">
                <div class="row">

                    <div class="col-9 training-content">
                        <h2 class="mb-3">Developing Resilience During Change</h2>
                        <p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="section-upcoming-courses-page">
    <div class="container-fluid">
        <div class="row d-flex justify-content-end gap-5">
            <div class="col-12 col-md-7">
                <div class="upcoming-courses-content">
                    <p>
                        When an individual is experiencing high levels of change, their capacity to adapt can rapidly be
                        depleted. Resilience—the ability to remain productive during turbulence—helps people achieve
                        better outcomes for themselves and their organizations. This one-day course explains why change
                        can be challenging and introduces a set of seven “change muscles” that help individuals use
                        their energy more effectively as they move through the adaptation process. Participants receive
                        individual feedback on their own resilience, and engage in exercises that provide practice in
                        applying each of the characteristics. They leave with an action plan for strengthening their
                        resilience. Optional additions include a module on leading and managing for resilience, and a
                        module designed to help intact teams explore their collective resilience.
                    </p>
                    <p>
                        This workshop is highly interactive. The instructor presents key concepts, then helps the
                        participants build personal connections through discussions, interactive exercises, and games.
                        Participants receive confidential individual feedback based on a questionnaire that is completed
                        in advance of the course. They complete an action plan for developing their personal resilience,
                        and are encouraged to reach out to others in the class to provide mutual support for
                        development.
                    </p>
                    <p>
                        This course is also available in French as "Développer la résilience lors d’un changement".
                    </p>
                    <p>
                        Learning Objectives
                        Participants will gain practical skills to:

                        Understand why change can be challenging
                        Recognize change-related disruption in work and personal settings
                        Identify signs that you and those around you are experiencing change overload
                        Formulate effective responses to change-related challenges
                        Enhance your own resilience
                        Deliver more effective performance during turbulence

                    </p>
                    <p>
                        Who Should Attend
                        Developing Personal Resilience is designed for:

                        Individual contributors
                        Supervisors
                        Lower to mid-level managers
                        Members of intact teams
                        This topic can also be delivered effectively to upper-level managers and senior leaders with
                        revisions to the format and design.



                        Prerequisite
                        Completion of Personal Resilience Questionnaire (online, available in multiple languages, takes
                        about 15-20 minutes).

                        Materials
                        You will receive a course binder containing copies of presentation slides, case studies,
                        exercises, and suggested solutions.

                        Why Change Can Be Challenging

                        Expectations and Control
                        Reactions to Change
                        Adaptation Capacity
                        Change-Related Overload


                        Introduction to Personal Resilience

                        Defining Resilience
                        Attributes of Resilient People
                        Overview of Resilience Characteristics


                        Your Personal Resilience Profile

                        What is the Personal Resilience Profile?
                        Reviewing Your Confidential Results
                        (Optional) Group Summary of Results


                        Exploring Your Resilience

                        Positive: The World
                        Positive: Yourself
                        Focused
                        Flexible: Thoughts
                        Flexible: Social
                        Organized
                        Proactive


                        Action Planning

                        Identifying Development Priorities
                        Completing an Action Plan
                        Committing to Next Steps


                        (Optional) Leading and Managing for Resilience

                        Your Resilience as a Leader
                        Supporting Others’ Development
                        Using Resilience in Teams
                        Building a Resilient Culture </p>
                </div>

            </div>
            <div class="col-12 col-md-4 mt-0">
                <div class="upcoming-courses-content-left">
                    <div id="carousel" class="tesimonial-carousel">
                        <div class="container testimonial-container">
                            <h6 class="upcoming-courses-testimonials-title">TESTIMONIALS</h6>
                            <ul class="upcoming-testimonial-list">
                                <li>
                                    <div class="upcoming-testimonial-content">
                                        <p>The three columns in the above table are Technical Project Management,
                                            Leadership, and Strategic & Business Management.</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><img src="{{asset('/img/upcoming_public_courses/marilyncourtemanche.jpg')}}"
                                                        alt="Testimonial Image"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="position-text">Your content goes here. This could be text,
                                                    other elements, etc.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="upcoming-testimonial-content">
                                        <p>The three columns in the above table are Technical Project Management,
                                            Leadership, and Strategic & Business Management.</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><img src="{{asset('/img/upcoming_public_courses/marilyncourtemanche.jpg')}}"
                                                        alt="Testimonial Image"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="position-text">Your content goes here. This could be text,
                                                    other elements, etc.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="upcoming-testimonial-content">
                                        <p>The three columns in the above table are Technical Project Management,
                                            Leadership, and Strategic & Business Management.</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><img src="{{asset('/img/upcoming_public_courses/marilyncourtemanche.jpg')}}"
                                                        alt="Testimonial Image"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="position-text">Your content goes here. This could be text,
                                                    other elements, etc.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="upcoming-testimonial-content">
                                        <p>The three columns in the above table are Technical Project Management,
                                            Leadership, and Strategic & Business Management.</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><img src="{{asset('/img/upcoming_public_courses/marilyncourtemanche.jpg')}}"
                                                        alt="Testimonial Image"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="position-text">Your content goes here. This could be text,
                                                    other elements, etc.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="dots-container">
                                <span class="dot" onclick="currentSlide(1)"></span>
                                <span class="dot" onclick="currentSlide(2)"></span>
                                <span class="dot" onclick="currentSlide(3)"></span>
                                <span class="dot" onclick="currentSlide(4)"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="upcoming-courses-content-info">
                    <div class="upcoming-testimonial-courses-info">
                        <h6 class="courses-info-title">COURSE INFO</h6>
                        <div class="course-info-content">
                            <p> Course ID: TS-5050</p>
                            <p> Course Level: Beginner</p>
                            <p> Duration: 1/2 or 1 day</p>
                        </div>
                        <div class="brochure-details">
                            <a href="#" target="_blank"><img
                                    src="{{asset('/img/upcoming_public_courses/brochure_button.png')}}"
                                    class="brochue-more-img" alt="learn-icon"></a>
                        </div>


                        <div class="video-testimonial mt-4">
                            <h6 class="video-testimonial-title">VIDEO TESTIMONIAL</h6>
                            <a href="#" target="_blank">
                                <p>View All</p>
                            </a>

                            <ul class="video-testimonial-list">
                                <li>
                                    <div class="views-field views-field-field-video-testimonial">
                                        <div class="field-content">
                                            <div class="media-youtube-video media-youtube-1">
                                                <iframe allowfullscreen="" class="media-youtube-player" frameborder="0"
                                                    height="315" src="https://www.youtube.com/embed/2MM_3--Zlb0"
                                                    width="560"></iframe>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>


                        <div class="upcoming-courses-sessions">
                            <h6 class="upcoming-courses-sessions-title">UPCOMING SESSIONS</h6>

                            <div class="row">
                                <div class="col-md-6 upcoming-session-img">
                                    <p><img src="{{asset('/img/upcoming_public_courses/online_course_icon.png')}}"
                                            alt="online_course_icon"></p>
                                </div>
                                <div class="col-md-6">
                                    <p>Beings September 5,2024
                                        Instructor(S): Carolynne Wintrip
                                        Starts in 67 days
                                        <a href="#" target="_blank">Register ></a>
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 upcoming-session-img">
                                    <p><img src="{{asset('/img/upcoming_public_courses/in_person_course_icon.png')}}"
                                            alt="online_course_icon"></p>
                                </div>
                                <div class="col-md-6">
                                    <p>Beings September 5,2024
                                        Instructor(S): Carolynne Wintrip
                                        Starts in 67 days
                                        <a href="#" target="_blank">Register ></a>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 upcoming-session-img">
                                    <p><img src="{{asset('/img/upcoming_public_courses/online_course_icon.png')}}"
                                            alt="online_course_icon"></p>
                                </div>
                                <div class="col-md-6">
                                    <p>Beings September 5,2024
                                        Instructor(S): Carolynne Wintrip
                                        Starts in 67 days
                                        <a href="#" target="_blank">Register ></a>
                                    </p>
                                </div>
                            </div>
                            <div class="session-button-details">
                                <a href="#" target="_blank"><img
                                        src="{{asset('/img/upcoming_public_courses/view_all_button.png')}}"
                                        class="session-all-img" alt="learn-icon"></a>
                            </div>
                        </div>
                        <div class="pmi-pdu-breakdown mt-4">
                            <h6 class="pmi-pdu-breakdown-title">PMI PDU BREAKDOWN</h6>

                            <div class="pmi-pdu-breakdown-content">
                                <p><img alt="PMI Talent Triangle"
                                        src="{{asset('/img/upcoming_public_courses/talent_triangle.jpg')}}"
                                        class="talent-triangle-img">
                                    The following table provides the breakdown of the professional development units
                                    (PDUs)
                                    for the <strong>1-day version</strong> of this course aligned with the PMI Talent
                                    Triangle<sup>TM</sup>.</p>
                            </div>
                            <table class="pmi-pdu-breakdown-table">
                                <tbody>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td class="wow-td"><strong>WoW</strong></td>
                                        <td class="ps-td"><strong>PS</strong></td>
                                        <td class="ba-td"><strong>BA</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>PMP</strong></td>
                                        <td class="rtecenter">0</td>
                                        <td class="rtecenter">7</td>
                                        <td class="rtecenter">0</td>
                                    </tr>
                                    <tr>
                                        <td><strong>PgMP</strong></td>
                                        <td class="rtecenter">0</td>
                                        <td class="rtecenter">7</td>
                                        <td class="rtecenter">0</td>
                                    </tr>
                                    <tr>
                                        <td><strong>PfMP</strong></td>
                                        <td class="rtecenter">0</td>
                                        <td class="rtecenter">7</td>
                                        <td class="rtecenter">0</td>
                                    </tr>
                                    <tr>
                                        <td><strong>PMI-ACP</strong></td>
                                        <td class="rtecenter">0</td>
                                        <td class="rtecenter">7</td>
                                        <td class="rtecenter">0</td>
                                    </tr>
                                    <tr>
                                        <td><strong>PMI-SP</strong></td>
                                        <td class="rtecenter">0</td>
                                        <td class="rtecenter">7</td>
                                        <td class="rtecenter">0</td>
                                    </tr>
                                    <tr>
                                        <td><strong>PMI-RMP</strong></td>
                                        <td class="rtecenter">0</td>
                                        <td class="rtecenter">7</td>
                                        <td class="rtecenter">0</td>
                                    </tr>
                                    <tr>
                                        <td><strong>PMI-PBA</strong></td>
                                        <td class="rtecenter">0</td>
                                        <td class="rtecenter">7</td>
                                        <td class="rtecenter">0</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>The three columns in the above table are Technical Project Management, Leadership, and
                                Strategic & Business Management.
                            </p>
                        </div>
                        <div class="other-credits mt-4">
                            <h6 class="pmi-pdu-breakdown-title">OTHER CREDITS</h6>
                            <p>Other professional (re)certification credits are available, including:</p>
                            <ul class="dexp_list dexp_list_02">
                                <li>Certified Business Analyst Professionals (CBAPs) earn 7 CDUs (Category 2B)</li>
                                <li>Certified Software Quality Engineers (CSQEs) earn 1 RUs</li>
                                <li>CIPS Information Systems Professionals (ISPs) earn 7 Learning Credits</li>
                                <li>CIPS Information Technology Certified Professional (ITCPs) earn 7 Learning Credits
                                </li>
                            </ul>
                            <div class="all-credits-button-details">
                                <a href="#" target="_blank"><img
                                        src="{{asset('/img/upcoming_public_courses/all_credits_button.png')}}"
                                        class="all-credits-img" alt="learn-icon"></a>
                            </div>
                        </div>



























                    </div>
                </div>
            </div>





        </div>
    </div>

</section>

@include('layouts.footer')
@endsection