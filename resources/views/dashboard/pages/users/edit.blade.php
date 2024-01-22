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
                                    <h6>Edit</h6>
                                    <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $user->name) }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status:</label>
                                        <select class="form-select" id="status" name="status" required>
                                            @foreach ([1 => 'Actived', 2 => 'Inactived', 3 => 'Banned'] as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ old('status', $user->status) == $value ? 'selected' : '' }}>
                                                    {{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Role:</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $user->role) }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', $user->email) }}" readonly>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Avatar:</label> <br>
                                        <div class="avatar avatar-xl position-relative">
                                            <img src="{{ asset('storage/profile-images/' . $user->profile_image) }}"
                                                alt="Profile Image">
                                        </div>
                                    </div>

                                    <!-- Add other input fields as needed -->

                                    <button type="submit" class="btn btn-primary">Update User</button>
                                </form>
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
