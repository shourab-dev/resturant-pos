<div class="col-lg-6">
    <div class="signin-wrapper">
        <div class="form-wrapper">
            <h6 class="mb-15">Sign In Form</h6>
            <p class="text-sm mb-25">
                Start creating the best possible user experience for you
                customers.
            </p>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Email</label>
                            <input name="email" type="email" placeholder="Email" />
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-12">
                        <div class="input-style-1">
                            <label>Password</label>
                            <input name="password" type="password" placeholder="Password" />
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-6 col-lg-12 col-md-6">
                        <div class="form-check checkbox-style mb-30">
                            <input name="remember" class="form-check-input" type="checkbox" value=""
                                id="checkbox-remember" />
                            <label class="form-check-label" for="checkbox-remember">
                                Remember me next time</label>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-6 col-lg-12 col-md-6">
                        <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                            <a href="{{ route('password.request') }}" class="hover-underline">
                                Forgot Password?
                            </a>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-12">
                        <div class="button-group d-flex justify-content-center flex-wrap">
                            <button class="main-btn primary-btn btn-hover w-100 text-center">
                                Sign In
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </form>
            <div class="singin-option pt-40">
                <p class="text-sm text-medium text-center text-gray">
                    Easy Sign In With
                </p>
                <div class="button-group pt-40 pb-40 d-flex justify-content-center flex-wrap">
                    <button class="main-btn primary-btn-outline m-2">
                        <i class="lni lni-facebook-fill mr-10"></i>
                        Facebook
                    </button>
                    <button class="main-btn danger-btn-outline m-2">
                        <i class="lni lni-google mr-10"></i>
                        Google
                    </button>
                </div>
                <p class="text-sm text-medium text-dark text-center">
                    Don’t have any account yet?
                    <a href="signup.html">Create an account</a>
                </p>
            </div>
        </div>
    </div>
</div>