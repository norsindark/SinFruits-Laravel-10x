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
                                    <h6>Users Table</h6>
                                    <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif


                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">

                                    @if ($users && count($users) > 0)
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        ID</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Name</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Email</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Role</th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Status</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>

                                                        {{-- role  --}}
                                                        <td>
                                                            {{ ['Order Status', 'Admin', 'User', 'Employee'][$user->role] }}
                                                        </td>

                                                        {{-- status  --}}
                                                        <td>
                                                            {{ ['Order Status', 'Actived', 'Inactive', 'Banned'][$user->status] }}
                                                        </td>

                                                        {{-- ban  --}}
                                                        <td class="text-center">
                                                            <a class="btn btn-link text-dark px-3 mb-0"
                                                                href="{{ route('dashboard.users.show', $user->id) }}">
                                                                <i class="fas fa-eye text-dark me-2"></i>View
                                                            </a>

                                                            <a class="btn btn-link text-dark px-3 mb-0"
                                                                href="{{ route('dashboard.users.edit', $user->id) }}">
                                                                <i class="fas fa-pencil-alt text-dark me-2"
                                                                    aria-hidden="true"></i>Edit
                                                            </a>

                                                            @if ($user->status != 3 && $user->role != 1)
                                                                <a href="javascript:;"
                                                                    class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                    onclick="confirmBan({{ $user->id }})">
                                                                    <i class="fas fa-ban me-2"></i>Ban
                                                                </a>

                                                                <form id="banForm{{ $user->id }}"
                                                                    action="{{ route('dashboard.users.ban', $user->id) }}"
                                                                    method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="status" value="3">
                                                                </form>
                                                            @elseif($user->role == 1)
                                                                Cann't Ban
                                                            @else
                                                                <i class="fas fa-ban me-2"></i>Banned
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No users found.</p>
                                    @endif
                                </div>
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

        {{-- confirm Ban  --}}
        <script>
            function confirmBan(userId) {
                if (confirm('Are you sure you want to ban this user?')) {
                    document.getElementById('banForm' + userId).submit();
                }
            }
        </script>

        {{-- confirm Update Role --}}
        {{-- <script>
            function confirmUpdateRole(userId) {
                var selectedRole = document.getElementById('role').value;
                document.getElementById('role' + userId).value = selectedRole;

                if (confirm('Are you sure you want to update this role?')) {
                    document.getElementById('updateFormRole' + userId).submit();
                }
            }
        </script> --}}


        {{-- confirm Update Status --}}

        {{-- <script>
            function confirmUpdateStatus(userId) {
                var selectedStatus = document.getElementById('status').value;
                document.getElementById('status' + userId).value = selectedStatus;

                var confirmationMessage = 'Are you sure you want to update this Status?';

                if (confirm(confirmationMessage)) {
                    document.getElementById('updateFormStatus' + userId).submit();
                }
            }
        </script> --}}

    </body>
@endsection
