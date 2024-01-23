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

                                {{-- login form --}}
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf



                                    <div class="single-input-item mb-3">
                                        <input type="email" name="email" :value="old('email')" required autofocus
                                            autocomplete="username" placeholder="Email">
                                    </div>



                                    <div class="single-input-item mb-3">
                                        <input type="password" name="password" required autocomplete="current-password" placeholder="Password">
                                    </div>



                                    <div class="single-input-item mb-3">
                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="remember-meta mb-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                                                    <label class="custom-control-label" for="rememberMe">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    @if (Route::has('password.request'))
                                        <div class="single-input-item mb-3">
                                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                                href="{{ url('/password-reset') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        </div>
                                    @endif




                                    <div class="single-input-item mb-3">
                                        <button class="btn obrien-button-2 primary-color">{{ __('Log in') }}</button>
                                        <button class="btn obrien-button-2 primary-color">
                                            @if (Route::has('register'))
                                                <a href="{{ url('/sign-up') }}">register
                                                </a>
                                            @endif
                                        </button>
                                    </div>


                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
