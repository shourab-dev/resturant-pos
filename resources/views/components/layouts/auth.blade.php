<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>{{ $title ?? 'Sign In' }}</title>

    <!-- ========== All CSS files linkup ========= -->

    @vite([
    'resources/backend/assets/css/bootstrap.min.css',
    'resources/backend/assets/css/lineicons.css',
    'resources/backend/assets/css/materialdesignicons.min.css',
    'resources/backend/assets/css/main.css'
    ])
    @livewireStyles
</head>

<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->



    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">


        <!-- ========== signin-section start ========== -->
        <section class="signin-section">
            <div class="container">
                <!-- ========== title-wrapper start ========== -->
                <div class="title-wrapper pt-30">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="title">
                                <h2>{{ $title ?? null }}</h2>
                            </div>
                        </div>
                        <!-- end col -->
                       
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- ========== title-wrapper end ========== -->

                <div class="row g-0 auth-row">
                    <div class="col-lg-6">
                        <div class="auth-cover-wrapper bg-primary-100">
                            <div class="auth-cover">
                                <div class="title text-center">
                                    <h1 class="text-primary mb-10">Welcome Back</h1>
                                    <p class="text-medium">
                                        Sign in to your Existing account to continue
                                    </p>
                                </div>
                                <div class="cover-image">
                                    <img src="{{ asset('backend/assets/images/auth/signin-image.svg') }}" alt="" />
                                </div>
                                <div class="shape-image">
                                    <img src="{{ asset('backend/assets/images/auth/shape.svg') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    {{ $slot }}
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </section>
        <!-- ========== signin-section end ========== -->

        <!-- ========== footer start =========== -->

    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    @vite(
    [
    "resources/backend/assets/js/bootstrap.bundle.min.js",
    "resources/backend/assets/js/main.js"
    ]
    )
    @livewireScripts
</body>

</html>