{{-- topbar --}}
<div class="topbar">
    <div class="topbar-left">
        <a href="#" class="logo">
            <div>
                <div class="logo-large" style="color: white; margin-top: 20px"><h4>SQM Portal </h4></div>
            </div>
            {{-- <img src="{{ asset('assets/images/logo.png') }}"    alt="" width="80%" class="logo-large"> --}}
            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" width="100%" class="logo-sm">
        </a>
    </div>

    <nav class="navbar-custom">
        <!-- Search input -->
        {{-- <div class="search-wrap" id="search-wrap">
            <div class="search-bar">
                <input class="search-input" type="search" placeholder="Search" />
                <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                    <i class="mdi mdi-close-circle"></i>
                </a>
            </div>
        </div> --}}

        <ul class="navbar-right d-flex list-inline float-right mb-0">
            {{-- <li class="list-inline-item dropdown notification-list flags-dropdown d-none d-sm-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                    <img src="assets/images/flags/us_flag.jpg" alt="" class="flag-img">
                    United States <i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-animated">
                    <a href="#" class="dropdown-item"><img src="assets/images/flags/french_flag.jpg" alt="" class="flag-img"> French</a>
                    <a href="#" class="dropdown-item"><img src="assets/images/flags/germany_flag.jpg" alt="" class="flag-img"> Germany</a>
                    <a href="#" class="dropdown-item"><img src="assets/images/flags/italy_flag.jpg" alt="" class="flag-img"> Italy</a>
                    <a href="#" class="dropdown-item"><img src="assets/images/flags/spain_flag.jpg" alt="" class="flag-img"> Spain</a>
                </div>
            </li> --}}

            {{-- <li class="list-inline-item dropdown notification-list">
                <a class="nav-link waves-effect toggle-search" href="#"  data-target="#search-wrap">
                    <i class="mdi mdi-magnify noti-icon"></i>
                </a>
            </li> --}}

            {{-- <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-bell-outline noti-icon"></i>
                    <span class="badge badge-info badge-pill noti-icon-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-arrow dropdown-menu-lg">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5>Notification (3)</h5>
                    </div>

                    <div class="slimscroll-noti">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item active">
                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                            <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i></div>
                            <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info"><i class="mdi mdi-filter-outline"></i></div>
                            <p class="notify-details"><b>Your item is shipped</b><span class="text-muted">It is a long established fact that a reader will</span></p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-success"><i class="mdi mdi-message-text-outline"></i></div>
                            <p class="notify-details"><b>New Message received</b><span class="text-muted">You have 87 unread messages</span></p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning"><i class="mdi mdi-cart-outline"></i></div>
                            <p class="notify-details"><b>Your order is placed</b><span class="text-muted">Dummy text of the printing and typesetting industry.</span></p>
                        </a>

                    </div>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item notify-all">
                        View All
                    </a>

                </div>
            </li> --}}

            <!-- User-->
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="user" class="rounded-circle">
                    <span class="d-none d-md-inline-block ml-1">{{ auth()->user()->username }} <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                    {{-- <a class="dropdown-item" href="{{ route('user.profile', auth()->user()->id) }}"><i class="dripicons-user text-muted"></i> Profile</a> --}}
                    {{-- <a class="dropdown-item" href="#"><i class="dripicons-wallet text-muted"></i> My Wallet</a> --}}
                    {{-- <a class="dropdown-item" href="#"><span class="badge badge-success float-right m-t-5">5</span><i class="dripicons-gear text-muted"></i> Settings</a> --}}
                    {{-- <a class="dropdown-item" href="#"><i class="dripicons-lock text-muted"></i> Lock screen</a> --}}
                    {{-- <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="dripicons-exit text-muted"></i> Logout</a>
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

    </nav>
</div>
