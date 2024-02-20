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
                                    <h6>Create Product</h6>
                                    <a href="{{ route('dashboard.products.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>


                            {{-- notification --}}
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

                            <div class="card-body ">
                                <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Title:</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Price:</label>
                                        <input type="number" class="form-control" id="price" name="price" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Quantity:</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Description:</label>
                                        <input type="textarea" class="form-control" id="description" name="description"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category:</label>
                                        <select class="form-control" id="category_id" name="category_id" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="image_path" class="form-label">Images:</label>
                                        <input type="file" class="form-control" id="image_path" name="image_path[]" multiple required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Warehouses:</label>
                                        <select class="form-control" id="warehouse_id" name="warehouse_id" required>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Product</button>
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
