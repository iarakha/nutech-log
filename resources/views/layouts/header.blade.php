<!--**********************************
            Nav header start
        ***********************************-->
<div class="nav-header">
    <a href="/dashboard" class="brand-logo">

        {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="55" height="55"
            viewBox="0 0 55 55">
            <image fill="text-primary" width="55" height="55"
                xlink:href="data:img/png;base64,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" />
        </svg> --}}
        <img src="{{asset('assets/images/logo/nlt_initials.png')}}" height="70" alt="">
        <div class="brand-title justify-content-center">
            <h2 class="text-primary">NLT.</h2>
            <span class="brand-sub-title" style="font-size: 12px">Nutech Log Troubleshoot </span>
        </div>
    </a>
    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<!--**********************************
            Nav header end
        ***********************************-->

<!--**********************************
            Header start
        ***********************************-->
<div class="header border-bottom">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar" style="font-size: 24px">
                        @yield('title')
                    </div>
                </div>
                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown  header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            @auth


                            <label for="" class=" px-3 mb-0">{{auth()->user()->name}}</label>
                            <img src={{asset('assets/icons/user-solid.svg')}} width="56" alt="">
                            {{-- <i class=" fas fa-solid fa-user fas-xl"></i> --}}

                            {{-- <img src="{{asset('assets/images/user.jpg')}}" width="56" alt=""> --}}
                            @endauth
                        </a>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{route('sign-out')}}" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                                    height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ms-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--**********************************
            Header end ti-comment-alt
        ***********************************-->