@extends('dashboard.layouts.master')


@section('content')

    <body class="g-sidenav-show  bg-gray-100">
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
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
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Categories Table</h6>
                                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    @if ($categories && count($categories) > 0)
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
                                                        Products</th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>{{ $category->id }}</td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>{{ $category->products->count() }}</td>
                                                        <td class="text-center">
                                                            <a class="btn btn-link text-dark px-3 mb-0"
                                                                href="{{ route('dashboard.categories.showByCategory', $category->slug) }}">
                                                                <i class="fas fa-eye text-dark me-2"></i>View
                                                            </a>

                                                            <a class="btn btn-link text-dark px-3 mb-0"
                                                                href="{{ route('dashboard.categories.edit', $category->id) }}">
                                                                <i class="fas fa-pencil-alt text-dark me-2"
                                                                    aria-hidden="true">
                                                                </i>Edit
                                                            </a>

                                                            <a href="javascript:;"
                                                                class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                onclick="confirmDelete({{ $category->id }})">
                                                                <i class="far fa-trash-alt me-2"></i>Delete
                                                            </a>

                                                            <form id="deleteForm{{ $category->id }}"
                                                                action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No categories found.</p>
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
            function confirmDelete(categoryId) {
                if (confirm('Are you sure you want to delete this category?')) {
                    document.getElementById('deleteForm' + categoryId).submit();
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
