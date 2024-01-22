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
                                    <h6>Edit Product</h6>
                                    <a href="{{ route('dashboard.products.index') }}" class="btn btn-primary">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name:</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $product->name }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category:</label>
                                        <select class="form-control" id="category_id" name="category_id" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Product Details --}}
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Product Description:</label>
                                        <input type="text" class="form-control" id="description" name="description"
                                            value="{{ $product->product_details->description }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Product Price:</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            value="{{ $product->product_details->price }}" required>
                                    </div>

                                    {{-- Product Images --}}
                                    {{-- <h5>Product Images</h5>
                                    @if ($product->productImages && count($product->productImages) > 0)
                                        <div class="row">
                                            @foreach ($product->productImages as $productImage)
                                                <div class="col-3 mb-3">
                                                    <img src="https://traicaytonyteo.com/{{ $productImage->image_path }}"
                                                        alt="Product Image" class="img-fluid"
                                                        style="width:125px; height: 125px;">
                                                    <!-- Add a delete button for each image -->
                                                    <form
                                                        action="{{ url('dashboard.product_images.destroy', $productImage->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger mt-2">Delete
                                                            Image</button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No images found for this product detail.</p>
                                    @endif --}}

                                    {{-- Add Image --}}
                                    {{-- <div class="mb-3">
                                        <label for="new_images" class="form-label">Add New Images:</label>
                                        <input type="file" class="form-control" id="new_images" name="new_images[]"
                                            accept="image/*" multiple>
                                    </div> --}}

                                    <button type="submit" class="btn btn-primary">Update Product</button>

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
