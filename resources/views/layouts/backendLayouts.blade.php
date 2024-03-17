<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>{{ env('APP_NAME') }} | @yield('title',"Dashboard")</title>

    @vite([
    'resources/backend/assets/css/bootstrap.min.css',
    'resources/backend/assets/css/lineicons.css',
    'resources/backend/assets/css/materialdesignicons.min.css',
    'resources/backend/assets/css/fullcalendar.css',
    'resources/backend/assets/css/main.css'
    ])
    @stack('customCss')
</head>

<body>

    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="index.html">
                <img src="assets/images/logo/logo.svg" alt="logo" />
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-controls="ddmenu_1"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.74999 18.3333C12.2376 18.3333 15.1364 15.8128 15.7244 12.4941C15.8448 11.8143 15.2737 11.25 14.5833 11.25H9.99999C9.30966 11.25 8.74999 10.6903 8.74999 10V5.41666C8.74999 4.7263 8.18563 4.15512 7.50586 4.27556C4.18711 4.86357 1.66666 7.76243 1.66666 11.25C1.66666 15.162 4.83797 18.3333 8.74999 18.3333Z" />
                                <path
                                    d="M17.0833 10C17.7737 10 18.3432 9.43708 18.2408 8.75433C17.7005 5.14918 14.8508 2.29947 11.2457 1.75912C10.5629 1.6568 10 2.2263 10 2.91665V9.16666C10 9.62691 10.3731 10 10.8333 10H17.0833Z" />
                            </svg>
                        </span>
                        <span class="text">Dashboard</span>
                    </a>
                    <ul id="ddmenu_1" class="collapse show dropdown-nav">
                        <li>
                            <a href="index.html" class="active"> eCommerce </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_2"
                        aria-controls="ddmenu_2" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.8097 1.66667C11.8315 1.66667 11.8533 1.6671 11.875 1.66796V4.16667C11.875 5.43232 12.901 6.45834 14.1667 6.45834H16.6654C16.6663 6.48007 16.6667 6.50186 16.6667 6.5237V16.6667C16.6667 17.5872 15.9205 18.3333 15 18.3333H5.00001C4.07954 18.3333 3.33334 17.5872 3.33334 16.6667V3.33334C3.33334 2.41286 4.07954 1.66667 5.00001 1.66667H11.8097ZM6.66668 7.70834C6.3215 7.70834 6.04168 7.98816 6.04168 8.33334C6.04168 8.67851 6.3215 8.95834 6.66668 8.95834H10C10.3452 8.95834 10.625 8.67851 10.625 8.33334C10.625 7.98816 10.3452 7.70834 10 7.70834H6.66668ZM6.04168 11.6667C6.04168 12.0118 6.3215 12.2917 6.66668 12.2917H13.3333C13.6785 12.2917 13.9583 12.0118 13.9583 11.6667C13.9583 11.3215 13.6785 11.0417 13.3333 11.0417H6.66668C6.3215 11.0417 6.04168 11.3215 6.04168 11.6667ZM6.66668 14.375C6.3215 14.375 6.04168 14.6548 6.04168 15C6.04168 15.3452 6.3215 15.625 6.66668 15.625H13.3333C13.6785 15.625 13.9583 15.3452 13.9583 15C13.9583 14.6548 13.6785 14.375 13.3333 14.375H6.66668Z" />
                                <path
                                    d="M13.125 2.29167L16.0417 5.20834H14.1667C13.5913 5.20834 13.125 4.74197 13.125 4.16667V2.29167Z" />
                            </svg>
                        </span>
                        <span class="text">Pages</span>
                    </a>
                    <ul id="ddmenu_2" class="collapse dropdown-nav">
                        <li>
                            <a href="settings.html"> Settings </a>
                        </li>
                        <li>
                            <a href="blank-page.html"> Blank Page </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-15">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-chevron-left me-2"></i> Menu
                                </button>
                            </div>
                            <div class="header-search d-none d-md-flex">
                                <form action="#">
                                    <input type="text" placeholder="Search..." />
                                    <button><i class="lni lni-search-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <!-- notification start -->
                            @include('layouts.components.notification')
                            <!-- notification end -->

                            <!-- profile start -->
                            @include('layouts.components.profile')
                            <!-- profile end -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">

                @yield('content')

                </div>
                <!-- end container -->
                </section>
                <!-- ========== section end ========== -->
                
                <!-- ========== footer start =========== -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 order-last order-md-first">
                                <div class="copyright text-center text-md-start">
                                    <p class="text-sm">
                                        Designed and Developed by
                                        <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                                            PlainAdmin
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <!-- end col-->
                            <div class="col-md-6">
                                <div class="terms d-flex justify-content-center justify-content-md-end">
                                    <a href="#0" class="text-sm">Term & Conditions</a>
                                    <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container -->
                </footer>
                <!-- ========== footer end =========== -->
                </main>
                <!-- ======== main-wrapper end =========== -->
                
                <!-- ========= All Javascript files linkup ======== -->
                
                @vite(
                [
                "resources/backend/assets/js/bootstrap.bundle.min.js",
                "resources/backend/assets/js/Chart.min.js",
                "resources/backend/assets/js/dynamic-pie-chart.js",
                "resources/backend/assets/js/moment.min.js",
                "resources/backend/assets/js/fullcalendar.js",
                "resources/backend/assets/js/jvectormap.min.js",
                "resources/backend/assets/js/world-merc.js",
                "resources/backend/assets/js/polyfill.js",
                "resources/backend/assets/js/main.js"
                ]
                )
                @stack('customJs')
                </body>
                
                </html>