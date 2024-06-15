<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/assets/css/styles.min.css'])

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logos/favicon.png') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ avenue_route('home') }}" class="text-nowrap logo-img">
                        <img src="{{ asset('images/avenue.png') }}" width="180" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        {{-- <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li> --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ avenue_route('home') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">{{ __('common.dashboard') }}</span>
                            </a>
                        </li>
                        {{-- <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">UI COMPONENTS</span>
                        </li> --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ avenue_route('reservations.index') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">{{ __('common.reservations') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ avenue_route('staffs.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user"></i>
                                </span>
                                <span class="hide-menu">{{ __('common.staffs') }}</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">{{ __('common.settings') }}</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ avenue_route('roles.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">{{ __('common.roles') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ avenue_route('types.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">{{ __('common.types') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ avenue_route('statuses.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-typography"></i>
                                </span>
                                <span class="hide-menu">{{ __('common.statuses') }}</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">Card</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Forms</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-typography"></i>
                                </span>
                                <span class="hide-menu">Typography</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">AUTH</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-login"></i>
                                </span>
                                <span class="hide-menu">Login</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">Register</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">EXTRA</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-mood-happy"></i>
                                </span>
                                <span class="hide-menu">Icons</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-aperture"></i>
                                </span>
                                <span class="hide-menu">Sample Page</span>
                            </a>
                        </li> --}}
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    {{-- <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul> --}}
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center">
                            @if (app()->getLocale() == 'en')
                                <li class="nav-item me-3">
                                    <a class="nav-link"
                                       href="{{ route(Route::currentRouteName(), array_merge(request()->route()->parameters(), ['locale' => 'ar'])) }}">
                                        <span class="h6">العربية</span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item me-3">
                                    <a class="nav-link"
                                       href="{{ route(Route::currentRouteName(), array_merge(request()->route()->parameters(), ['locale' => 'en'])) }}">
                                        <span class="h6">English</span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link d-flex align-items-center" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="me-2">{{ Auth::user()->name }}</span>
                                    <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('images/profile/user-1.jpg') }}"
                                         alt="User Image" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="{{ avenue_route('profile.index') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">{{ __('common.profile') }}</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="{{ avenue_route('logout') }}" class="btn btn-outline-primary mx-3 mt-2 d-block"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ avenue_route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    @vite(['resources/assets/libs/jquery/dist/jquery.min.js', 'resources/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js', 'resources/assets/js/sidebarmenu.js', 'resources/assets/js/app.min.js', 'resources/assets/libs/simplebar/dist/simplebar.js', 'resources/assets/libs/apexcharts/dist/apexcharts.min.js', 'resources/assets/js/dashboard.js'])
</body>

</html>
