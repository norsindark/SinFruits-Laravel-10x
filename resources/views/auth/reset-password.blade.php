@extends('client.layouts.master')
<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico" />
<link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/vendor/font.awesome.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/vendor/ionicons.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}" />
<link rel="stylesheet" href="{{ asset(' assets/css/style.css') }}" />

@section('content')

    <body>

        <div class="contact-wrapper">
            <!-- Login Area Start Here -->
            <div class="login-register-area mt-no-text mb-no-text">
                <div class="container container-default-2 custom-area">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                            <div class="login-register-wrapper">
                                <div class="section-content text-center mb-5">
                                    <h2 class="title-4 mb-2">Forgot Password</h2>

                                </div>
                                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                </div>
                                <form method="POST" action="{{ route('password.store') }}">
                                    @csrf

                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}

                                    <!-- Email Address -->
                                    <div class="single-input-item mb-3">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                            :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="single-input-item mb-3">
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input id="password" class="block mt-1 w-full" type="password"
                                            name="password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="single-input-item mb-3">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="btn obrien-button-2 primary-color">
                                            {{ __('Reset Password') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login Area End Here -->
            <!-- Support Area Start Here -->
            <div class="support-area">
                <div class="container container-default custom-area">
                    <div class="row">
                        <div class="col-lg-12 col-custom">
                            <div class="support-wrapper d-flex">
                                <div class="support-content">
                                    <h1 class="title">Need Help ?</h1>
                                    <p class="desc-content">Call our support 24/7 at 01234-567-890</p>
                                </div>
                                <div class="support-button d-flex align-items-center">
                                    <a class="obrien-button primary-btn" href="contact-us.html">Contact now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Support Area End Here -->
        </div>
    </body>
@endsection


{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
