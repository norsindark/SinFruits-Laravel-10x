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
                                    <h2 class="title-4 mb-2">Login</h2>
                                    <p class="desc-content">Please login using account detail bellow.</p>
                                </div>
                                @if (session('status') == 'verification-link-sent')
                                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            @endif
                        
                            <div class="mt-4 flex items-center justify-between">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                        
                                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                        <x-primary-button class="btn obrien-button-2 primary-color">
                                            {{ __('Resend Verification Email') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                        
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                        
                                    <button type="submit" class="btn obrien-button-2 primary-color">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                                <div >
                                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login Area End Here -->

        </div>
    </body>
@endsection
