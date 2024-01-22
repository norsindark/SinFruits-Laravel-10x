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
                                    <h6>Products Details</h6>
                                    <a href="{{ route('dashboard.products.index') }}" class="btn btn-primary">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <strong>ID:</strong> {{ $product->id }}<br>
                                    <strong>Name:</strong> {{ $product->name }}<br>
                                    <strong>Category:</strong>
                                    {{ $product->category ? $product->category->name : 'N/A' }}<br>

                                    <strong>Description:</strong>
                                    {{ $product->product_details ? $product->product_details->description : 'N/A' }}<br>

                                    <strong>Price:</strong>
                                    {{ $product->product_details ? $product->product_details->price : 'N/A' }}<br>

                                    <strong>Quantity:</strong>
                                    {{ $product->product_warehouse->where('product_id', $product->id)->first() ? $product->product_warehouse->where('product_id', $product->id)->first()->quantity : 'N/A' }}<br>

                                    <strong>Warehouse:</strong>
                                    {{ $product->product_warehouse->isNotEmpty() ? $product->product_warehouse->first()->warehouse->name : 'N/A' }}<br>

                                    <strong>Date Added:</strong> {{ $product->created_at ? $product->created_at->toDateString() : 'N/A' }}<br>

                                    <strong>Images:</strong><br>
                                    @if ($product->productImages->count() > 0)
                                        <div class="image-slider">
                                            @foreach ($product->productImages as $productImage)
                                                <img src="{{ $productImage->image_path }}"
                                                    alt="Product Image" class="image-slide">
                                            @endforeach
                                        </div>
                                    @else
                                        N/A
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
    </body>
    <style>
        .image-slider {
            display: flex;
            /* Đặt thành dạng flex để các hình ảnh nằm ngang */
        }

        .image-slide {
            width: 75px;
            /* Đặt chiều rộng mong muốn */
            height: 75px;
            /* Đặt chiều cao mong muốn */
            margin-right: 5px;
            /* Thêm khoảng trắng giữa các hình ảnh */
        }
    </style>
@endsection
