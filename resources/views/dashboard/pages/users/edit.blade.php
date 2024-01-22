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
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Avatar:</label><br>
                                    @if ($user->profile_image != null)
                                        <div class="avatar avatar-xl position-relative">
                                            <img src="{{ asset('storage/profile-images/' . $user->profile_image) }}"
                                                alt="Profile Image">
                                        </div>
                                        <a href="javascript:;" class="btn btn-link text-danger text-gradient px-3 mb-0"
                                            onclick="confirmDelete({{ $user->id }})">
                                            <i class="far fa-trash-alt me-2"></i>
                                        </a>

                                        <form id="deleteForm{{ $user->id }}"
                                            action="{{ route('dashboard.users.deleteImage', $user->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @else
                                        <div>
                                            Don't updated
                                        </div>
                                    @endif
                                </div>

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
                                            @foreach ([1 => 'Actived', 2 => 'Inactive', 3 => 'Banned'] as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ old('status', $user->status) == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role:</label>
                                        <select class="form-select" id="role" name="role" required>
                                            @foreach ([1 => 'Admin', 2 => 'User', 3 => 'Employee'] as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ old('role', $user->role) == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', $user->email) }}" readonly>
                                    </div>



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

        {{-- Delete Image  --}}
        <script>
            function confirmDelete(userId) {
                if (confirm('Are you sure you want to delete this image?')) {
                    document.getElementById('deleteForm' + userId).submit();
                }
            }
        </script>

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
