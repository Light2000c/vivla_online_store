@extends('layouts.auth.app')

@section('content')

    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-xl-4 col-sm-6">
                    <a href="{{  route("home") }}" class="site-logo"><img src="/logo/VIVLA MAIN LOGO WEBT2.png" alt="logo" width="40" height="157"></a>
                </div>
                <div class="col-md-2 d-lg-block d-none">
                    <a href="{{ route("login") }}" class="back-btn"><i class="far fa-angle-left"></i></a>
                </div>
                <div class="col-xl-6 col-lg-4 col-sm-6">
                    <div class="singin-header-btn">
                        <a href="{{ route("home") }}" class="sign-up-btn axil-btn btn-bg-secondary">Home</a>
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
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">

                        <div class="card">
                            {{-- <h3 class="title ">{{ __('Verify Your Email Address') }}</h3> --}}
                            <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                            <div class="card-body p-2 m-4">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <div class="d-flex justify-content-center mb-3">
                                    <button type="submit"
                                        class="axil-btn btn-bg-primary submit-btn btn-sm mt-5">{{ __('click here to request another') }}</button>
                                    </div>
                                    {{-- <button type="submit" class="btn btn-outline p-0 m-0 align-baseline">{{ __('click here to request another') }}</button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   @endsection