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
                                    <h6>Warehouse Details</h2>
                                        <a href="{{ route('dashboard.warehouses.index') }}" class="btn btn-primary">
                                            <i class="fas fa-arrow-left"></i>
                                        </a>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
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
                                                    Products in stock
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $warehouse->id }}</td>
                                                <td>{{ $warehouse->name }}</td>
                                                <td>
                                                    @if ($productCount > 0)
                                                        {{ $productCount }}
                                                    @else
                                                        <p>No products found in this warehouse.</p>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-link text-dark px-3 mb-0"
                                                        href="{{ route('dashboard.warehouses.showProducts', $warehouse->id) }}">
                                                        <i class="fas fa-eye text-dark me-2"></i>View
                                                    </a>
                                                </td>
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
