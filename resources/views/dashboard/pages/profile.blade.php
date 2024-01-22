@extends('dashboard.layouts.master')


@section('content')

    <body class="g-sidenav-show bg-gray-100">

        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">

            <div class="container-fluid">
                <div class="page-header min-height-300 border-radius-xl mt-4"
                    style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                    <span class="mask bg-gradient-primary opacity-6"></span>
                </div>
                <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                    <div class="row gx-4">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative">
                                <img src="{{ asset('storage/profile-images/' . auth()->user()->profile_image) }}"
                                    alt="Profile Image">
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    {{ Auth::user()->name }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid py-4">
                <div class="row">
                    @php
                        $profileSections = [
                            ['partial' => 'update-profile-information-form', 'header' => 'Edit Profile'],
                            ['partial' => 'update-password-form', 'header' => 'Edit Profile'],
                            ['partial' => 'update-image-form', 'header' => 'Edit Profile'],
                        ];
                    @endphp
            
                    @foreach($profileSections as $section)
                        <div class="col-12 col-xl-4">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                    <h6 class="mb-0">{{ $section['header'] }}</h6>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="max-w-xl">
                                                @include('profile.partials.' . $section['partial'])
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            
                <footer class="footer pt-3">
                    <div class="container-fluid">
                        <div class="row align-items-center justify-content-lg-between">
                            <div class="col-lg-6 mb-lg-0 mb-4">
                                <div class="copyright text-center text-sm text-muted text-lg-start">
                                    © <script>document.write(new Date().getFullYear())</script>,
                                    made with <i class="fa fa-heart"></i> by
                                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">SinD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            
        </div>
        <script async defer src="https://buttons.github.io/buttons.js"></script>

    </body>
@endsection
