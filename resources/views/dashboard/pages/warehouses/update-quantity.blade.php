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
                                    <h6>Product - Warehouse: {{ $item->name }}</h6>
                                    <div class="col-auto">

                                    </div>
                                    <a href="{{ route('dashboard.warehouses.index') }}" class="btn btn-primary">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>

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
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $item->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Images: </th>
                                            <td>
                                                <div class="avatar avatar-xl position-relative">
                                                    @php
                                                        $imagePath = $item->productImages->isNotEmpty() ? asset($item->productImages->first()->image_path) : asset('path_to_default_image/default_image.jpg');
                                                    @endphp
                                                    <img src="{{ $imagePath }}" alt="Product Image" class="img-fluid">
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Unit Price:</th>
                                            <td>{{ number_format($item->product_details->price) }} VNĐ</td>
                                        </tr>

                                        <tr>
                                            <th>Import Quantity:</th>
                                            <td>{{ number_format($item->quantity->import_quantity) }} Kg</td>
                                        </tr>

                                        <tr>
                                            <th>Sold:</th>
                                            <td>{{ number_format($item->quantity->quantity_sold) }} Kg</td>
                                        </tr>

                                        <tr>
                                            <th>In Stocks:</th>
                                            <td>{{ number_format($item->quantity->quantity) }} Kg</td>
                                        </tr>

                                        <tr>
                                            <form id="updateForm{{ $item->id }}"
                                                action="{{ route('dashboard.warehouses.updateQuantity', $item->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('PUT')
                                                <th>
                                                    <input type="text" class="form-control" id="quantity"
                                                        placeholder="Enter the quantity to add" name="quantity"
                                                        value="{{ old('name', $item->quantity) }}" required>
                                                </th>
                                            </form>

                                            <td>
                                                <a href="javascript:;"
                                                    class="btn btn-link text-dark text-gradient px-3 mb-0"
                                                    onclick="confirmUpdate({{ $item->id }})">
                                                    <i class="fa-solid fa-check-to-slot"></i> Update Quantity
                                                </a>
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


        {{-- comfirmDelete --}}
        <script>
            function confirmUpdate(item) {
                if (confirm('Are you sure to update this quantity?')) {
                    document.getElementById('updateForm' + item).submit();
                }
            }
        </script>

    </body>
@endsection
