<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>{{ $title ?? 'Page Title' }}</title>

    @vite([
    'resources/backend/assets/css/bootstrap.min.css',
    'resources/backend/assets/css/lineicons.css',
    'resources/backend/assets/css/materialdesignicons.min.css',
    'resources/backend/assets/css/fullcalendar.css',
    'resources/backend/assets/css/main.css'
    ])
    @livewireStyles
</head>

<body>
  
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <img src="{{ asset('backend/assets/images/logo/logo.svg') }}" alt="logo" />
            </a>
        </div>
        <nav class="sidebar-nav">
            @livewire('utils.dashboard-sidebar')
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
                            <livewire:utils.branch.branch-selector />
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <!-- notification start -->
                            @livewire('utils.notification')
                            <!-- notification end -->

                            <!-- profile start -->
                            @auth
                            @livewire('utils.avatar-profile')
                            @endauth
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

                {{ $slot }}

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(
    [
    "resources/backend/assets/js/bootstrap.bundle.min.js",
    "resources/backend/assets/js/Chart.min.js",
    "resources/backend/assets/js/dynamic-pie-chart.js",
    // "resources/backend/assets/js/moment.min.js",
    "resources/backend/assets/js/fullcalendar.js",
    "resources/backend/assets/js/jvectormap.min.js",
    "resources/backend/assets/js/world-merc.js",
    "resources/backend/assets/js/polyfill.js",
    "resources/backend/assets/js/main.js"
    ]
    )
    @livewireScripts
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
            },
            });
        window.addEventListener('toast', (e) => {
            const {type,msg} = e.detail[0]
                
                Toast.fire({
                icon: type,
                title: msg,
                });
            
        })
    </script>
</body>

</html>