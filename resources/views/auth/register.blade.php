@extends('layouts.auth.app')

@section('content')
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="{{ route('home') }}" class="site-logo"><img src="/logo/VIVLA MAIN LOGO WEBT2.png" alt="logo"
                            width="40" height="157"></a>
                </div>
                <div class="col-md-6">
                    <div class="singin-header-btn">
                        <p>Already a member?</p>
                        <a href="{{ route('login') }}" class="axil-btn btn-bg-secondary sign-up-btn">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                    {{-- <h3 class="title">We Offer the Best Products</h3> --}}
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap mb-5">
                    <div class="axil-signin-form">
                        <h3 class="title">I'm New Here</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        @if (session('error'))
                            <div class="alert alert-danger mb-4" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('register') }}" class="singin-form" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    placeholder="Full Name">
                                @error('name')
                                    <small class="text-danger text-start">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                    placeholder="name@example.com">
                                @error('email')
                                    <small class="text-danger text-start">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group auth-wrapper" >
                                <label>Phone</label>
                                <div class="input-group col-12 pe-5">
                                    {{-- <input type="tel" id="phone" class="form-control tel-input auth-phone" name="phone"> --}}
                                    <input type="tel" id="phone" class="form-control tel-input" name="phone">
                                    <input type="hidden" id="full_phone" name="full_phone">
                                </div>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label style="z-index: 2;">Password</label>
                                <div class="input-group mb-3">
                                    <input name="password" type="password" class="form-control"
                                        aria-describedby="basic-addon2" style="background: none; z-index: 1;">
                                    <span class="input-group-text">
                                        <i onclick="viewPassword(event, 'password')"
                                            class="bi bi-eye-slash-fill fs-1"></i></span>
                                </div>
                                @error('password')
                                    <small class="text-danger text-start">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label style="z-index: 2;">Confirm Password</label>
                                <div class="input-group mb-3">
                                    <input name="password_confirmation" type="password" class="form-control"
                                        aria-describedby="basic-addon2" style="background: none; z-index: 1;">
                                    <span class="input-group-text">
                                        <i onclick="viewPassword(event, 'password_confirmation')"
                                            class="bi bi-eye-slash-fill fs-1"></i></span>
                                </div>
                            </div>

                            <div class="form-group mb-5 pb-5">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">Create
                                    Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        function viewPassword(e, inputName) {
            e.preventDefault();

            const passwordInput = document.querySelector(`input[name="${inputName}"]`);
            const icon = e.target;

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            } else {
                passwordInput.type = "password";
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            }

            console.log("visibility toggled");
        }
    </script>
@endsection
