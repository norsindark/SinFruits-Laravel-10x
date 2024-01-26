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
                                    <h6>Warehouses Table</h6>
                                    <a href="{{ route('dashboard.warehouses.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    {{-- <a href="{{ route('dashboard.warehouses.updateQuantitySold') }}"
                                        class="btn btn-primary">Update Quantity
                                        Sold</a> --}}
                                </div>
                            </div>

                            {{-- Notification --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    @if ($warehouses && count($warehouses) > 0)
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
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($warehouses as $warehouse)
                                                    <tr>
                                                        <td>{{ $warehouse->id }}</td>
                                                        <td>{{ $warehouse->name }}</td>
                                                        <td class="text-center">
                                                            <a class="btn btn-link text-dark px-3 mb-0"
                                                                href="{{ route('dashboard.warehouses.show', $warehouse->id) }}">
                                                                <i class="fas fa-eye text-dark me-2"></i>View
                                                            </a>

                                                            <a class="btn btn-link text-dark px-3 mb-0"
                                                                href="{{ route('dashboard.warehouses.edit', $warehouse->id) }}">
                                                                <i class="fas fa-pencil-alt text-dark me-2"
                                                                    aria-hidden="true">
                                                                </i>Edit Name
                                                            </a>

                                                            {{-- <a href="javascript:;"
                                                                class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                onclick="confirmDelete({{ $warehouse->id }})">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                            </a>

                                                            <form id="deleteForm{{ $warehouse->id }}"
                                                                action="{{ route('dashboard.warehouses.destroy', $warehouse->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form> --}}
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No warehouses found.</p>
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

        {{-- comfirmDelete --}}
        <script>
            function confirmDelete(warehouseId) {
                if (confirm('Are you sure you want to delete this category?')) {
                    document.getElementById('deleteForm' + warehouseId).submit();
                }
            }
        </script>

    </body>
@endsection
