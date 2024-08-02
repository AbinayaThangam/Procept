<header class="header-container top-header py-3 justify-content-between">
    <div class="row">
        <div class="col-2 m-auto">
            <a class="navbar-brand" href="{{ config('app_constants.PROCEPT_COM')}}" target="_blank">
                <img src="{{ asset('/img/header_image/Procept Logo.png') }}" alt="Logo" width="260" height="80">
            </a>
        </div>
        <div class="col-6 top-menu-bar justify-content-center align-items-center m-auto">
              {{-- Training MenuBar Details --}}
              @foreach($menuBarDetails as $menu)
              <nav class="menu-container">
                  <ul class="main-menu">
                      <li class="menu-item">
                          <a href="{{ $menu['url'] ?? '#' }}"
                             @if (!empty($menu['url'])) target="_blank" @endif
                             class="{{ !empty($menu['url']) ? 'active' : '' }}">
                              {{ $menu['title'] }}
                          </a>
                          @if (!empty($menu['submenus']))
                              <div class="mega-submenu">
                                  <ul class="sub-menu">
                                      @foreach($menu['submenus'] as $submenu)
                                          <li class="sub-menu-item">
                                              <a href="{{ $submenu['url'] ?? '#' }}"
                                                 @if (!empty($submenu['url'])) target="_blank" @endif
                                                 class="{{ !empty($submenu['url']) ? 'active' : ''}}">
                                                  {{ $submenu['title'] }}
                                              </a>
                                              @if (!empty($submenu['submenus']))
                                                  <ul class="nested-menu">
                                                      @foreach($submenu['submenus'] as $nestedMenu)
                                                          <li class="nested-menu-item">
                                                              <a href="{{ $nestedMenu['url'] ?? '#' }}"
                                                                 @if (!empty($nestedMenu['url'])) target="_blank" @endif
                                                                 class="{{ !empty($nestedMenu['url']) ? 'active' : '' }}">
                                                                  {{ $nestedMenu['title'] }}
                                                              </a>
                                                          </li>
                                                      @endforeach
                                                  </ul>
                                              @endif
                                          </li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                      </li>
                  </ul>
              </nav>
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
                <input placeholder="Search" class="form-control border-0 page-search-courses">
                <img src="{{ asset('/img/search_and_video/Seach icon.png') }}" alt="search-icon"
                    class="img-fluid training-search-icon page-search-courses" style="">
            </div>
            <div class="filter-page-courses-container" style="display: none;">
                <div id="filter-page-courses-container" class="container" style="display: none;">
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


<div class="course-navigation d-none">
    <input type="hidden" id="selected-nid">
    <input type="hidden" id="selected-node-type">
    <input type="hidden" id="selected-page-nid">

    <a href="" id="course-summary">
    </a>

</div>

