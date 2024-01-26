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
                                    <h6>Products in Warehouse: {{ $warehouse->name }}</h6>
                                    <a href="{{ route('dashboard.warehouses.index') }}" class="btn btn-primary">
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($products && count($products) > 0)
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    ID
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Name
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Day added
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Quantity in stock
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->product->id }}</td>
                                                    <td>{{ $product->product->name }}</td>
                                                    <td>{{ $product->product->created_at->format('Y-m-d') }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-link text-dark px-3 mb-0"
                                                            href="{{ route('dashboard.warehouses.updateQuantity', $product->product->id) }}">
                                                            <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true">
                                                            </i>update quantity
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No products found in this warehouse.</p>
                                @endif

                                {{-- pagination --}}
                                <div style="padding: 0px 120px;">
                                    {{ $products->links('vendor.pagination.bootstrap-5') }}
                                </div>
                                {{-- pagination --}}
                            </div>
                        </div>
                    </div>
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
