<header class="header-container top-header py-3 justify-content-between">
    <div class="row">
        <div class="col-2 m-auto">
            <a class="navbar-brand" href="{{ config('app_constants.PROCEPT_COM')}}" target="_blank">
                <img src="{{ asset('/img/header_image/Procept Logo.png') }}" alt="Logo" width="260" height="80">
            </a>
        </div>
        <div class="col-6 top-menu-bar justify-content-center align-items-center m-auto">
              {{-- Training MenuBar Details --}}
              @foreach($trainingMenuBarDetails as $menu)
              <div class="container">
                  <div class="dropdown">
                      <a class="dropdown-toggle" href="{{ $menu['url'] ?? '#' }}" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"
                      @if (!empty($menu['url'])) target="_blank" @endif>
                       {{ $menu['title'] }}
                   </a>
                      @if(!empty($menu['submenus']))
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              @foreach($menu['submenus'] as $submenu)
                                  <li class="dropdown-submenu">
                                      <a class="dropdown-item {{ !empty($submenu['submenus']) ? 'dropdown-toggle' : '' }}" href="{{ $submenu['url'] ?? '#' }}"
                                         @if (!empty($submenu['url'])) target="_blank" @endif>
                                          {{ $submenu['title'] }}
                                      </a>
                                      @if(!empty($submenu['submenus']))
                                          <ul class="dropdown-menu">
                                              @foreach($submenu['submenus'] as $subsubmenu)
                                                  <li>
                                                      {{-- $subsubmenu['url'] ?? '#' --}}
                                                      <a class="dropdown-item" href="{{ route('course.type.details', ['courses_type_slug' => $subsubmenu['url']]) }}"
                                                          @if (!empty($subsubmenu['url'])) target="_blank" @endif>
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
                                    <a class="dropdown-item" href="{{ $subsubmenu['url'] ?? '#' }}"
                                        @if(!empty($subsubmenu['url'])) target="_blank" @endif>
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


</header>
