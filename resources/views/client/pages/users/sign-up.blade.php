@extends('client.layouts.master')


@section('content')

    <body>

        <div class="contact-wrapper">
            <!-- Breadcrumb Area Start Here -->
            <div class="breadcrumbs-area position-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="breadcrumb-content position-relative section-content">
                                <h3 class="title-3">Login-Register</h3>
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Login-Register</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb Area End Here -->
            <!-- Login Area Start Here -->
            <div class="login-register-area mt-no-text mb-no-text">
                <div class="container container-default-2 custom-area">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                            <div class="login-register-wrapper">
                                <div class="section-content text-center mb-5">
                                    <h2 class="title-4 mb-2">Create Account</h2>
                                    <p class="desc-content">Please Register using account detail bellow.</p>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="single-input-item mb-3">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                            :value="old('name')" required autofocus />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="single-input-item mb-3">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                            :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="single-input-item mb-3">
                                        <x-input-label for="password" :value="__('Enter your Password')" />
                                        <x-text-input id="password" class="block mt-1 w-full" type="password"
                                            name="password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="single-input-item mb-3">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="single-input-item mb-3">
                                        <x-primary-button
                                            class="btn obrien-button-2 primary-color">{{ __('Register') }}</x-primary-button>
                                    </div>
                                </form>
                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                        href="{{ url('/sign-in') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login Area End Here -->


            <!-- Support Area Start Here -->
            @include('client.components.support')
            <!-- Support Area End Here -->
        </div>

        <!-- JS-->

    </body>
@endsection
