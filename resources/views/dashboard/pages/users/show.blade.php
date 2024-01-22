@extends('dashboard.layouts.master')


@section('content')

    <body class="g-sidenav-show  bg-gray-100">
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>User Details: {{ $user->name }}</h6>
                                    <div class="col-auto">

                                    </div>
                                    <a href="{{ route('dashboard.users.index') }}" class="btn btn-primary">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $user->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Orders purchased</th>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                            <th>Role</th>
                                            <td>{{ ['Other Role', 'Admin', 'User'][$user->role] }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $user->email_verified_at ? 'Active' : 'Inactive' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Avatar</th>
                                            <td>
                                                @if ($user->profile_image != null)
                                                    <div class="avatar avatar-xl position-relative">
                                                        <img src="{{ asset('storage/profile-images/' . $user->profile_image) }}"
                                                            alt="Profile Image">
                                                    </div>
                                                @else
                                                    <div>
                                                        Not Update
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- footer --}}
                @include('dashboard.layouts.footer')
                {{-- footer --}}

            </div>
        </div>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
    </body>
@endsection
