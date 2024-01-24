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
                                    <h6>Orders Table:
                                        <a href="{{ route('dashboard.products.create') }}">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    @if ($products && count($products) > 0)
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        ID
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        User Email
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Date
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Status
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Total
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($billOrders as $item)
                                                    <tr>
                                                        <td>IC {{ $item->id }}</td>

                                                        <td>{{ $item->user->email }}</td>

                                                        <td>{{ $item->created_at }}</td>

                                                        <td>{{ [
                                                            'Pending', 
                                                            'Processing', 
                                                            'Completed', 
                                                            'Pending Cancellation', 
                                                            'Canceled', 
                                                            'Unknown Status'
                                                            ][$item->status] }}
                                                        </td>

                                                        <td>{{ number_format($item->total_amount, 0, '.', '.') }} VND</td>


                                                        <td class="text-center">
                                                            <a class="btn btn-link text-dark px-3 mb-0"
                                                                href="{{ url('dashboard.orders.show', $item->id) }}">
                                                                <i class="fas fa-eye text-dark me-2"></i>View
                                                            </a>

                                                            <a class="btn btn-link text-dark px-3 mb-0"
                                                                href="{{ url('dashboard.orders.edit', $item->id) }}">
                                                                <i class="fas fa-pencil-alt text-dark me-2"
                                                                    aria-hidden="true">
                                                                </i>Edit
                                                            </a>

                                                            <a href="javascript:;"
                                                                class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                onclick="confirmRemove({{ $item->id }})">
                                                                <i class="far fa-trash-alt me-2"></i>Remove
                                                            </a>

                                                            <form id="deleteForm{{ $item->id }}"
                                                                action="{{ url('dashboard.orders.remove', $item->id) }}"
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
                                        <p>No Orders found.</p>
                                    @endif

                                    {{-- pagination --}}
                                    <div style="padding: 0px 120px;">
                                        {{ $billOrders->links('vendor.pagination.bootstrap-5') }}
                                    </div>
                                    {{-- pagination --}}

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

        {{-- Remove Order  --}}
        <script>
            function confirmRemove(productId) {
                if (confirm('Are you sure you want to delete this category?')) {
                    document.getElementById('deleteForm' + productId).submit();
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
