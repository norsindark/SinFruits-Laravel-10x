@extends('dashboard.layouts.master')


@section('content')

    <body class="g-sidenav-show  bg-gray-100">
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">

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

                            {{-- Titel --}}
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Orders Table: </h6>
                                </div>
                            </div>


                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    @if ($billOrders && count($billOrders) > 0)
                                        <table class="table align-items-center mb-0">
                                            <thead>

                                                {{-- title menu --}}
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
                                                        {{-- id --}}
                                                        <td>IC {{ $item->id }}</td>

                                                        {{-- user email --}}
                                                        <td>{{ $item->user->email }}</td>

                                                        {{-- order created at --}}
                                                        <td>{{ $item->created_at }}</td>

                                                        {{-- status --}}
                                                        <td>{{ ['Pending', 'Processing', 'Completed', 'Pending Cancellation', 'Canceled', 'Unknown Status'][$item->status] }}
                                                        </td>

                                                        {{-- price --}}
                                                        <td>{{ number_format($item->total_amount, 0, '.', '.') }} VNĐ</td>


                                                        {{-- action --}}
                                                        <td class="text-center">
                                                            <a class="btn btn-link text-dark px-3 mb-0 view-btn"
                                                                href="#" data-order-id="{{ $item->id }}">
                                                                <i class="fas fa-eye text-dark me-2"></i>View
                                                            </a>


                                                            <a href="#"
                                                                class="btn btn-link text-dark px-3 mb-0 edit-btn"
                                                                data-order-id="{{ $item->id }}">
                                                                <i class="fas fa-pencil-alt text-dark me-2"
                                                                    aria-hidden="true"></i>Update status
                                                            </a>

                                                        </td>


                                                    </tr>


                                                    {{-- edit status drop down --}}
                                                    @include('dashboard.pages.orders.edit-status')


                                                    {{-- Order items drop-down --}}
                                                    @include('dashboard.pages.orders.order-drop-down')
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


        {{-- order view drop down --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.view-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var orderId = this.getAttribute('data-order-id');

                        toggleOrderItems(orderId);
                    });
                });

                function toggleOrderItems(orderId) {
                    var orderItemsRow = document.getElementById('order-items-' + orderId);
                    if (orderItemsRow) {
                        if (orderItemsRow.style.display === 'table-row') {
                            orderItemsRow.style.display = 'none';
                        } else {
                            orderItemsRow.style.display = 'table-row';
                        }
                        hideOtherOrderItems(orderId);
                    }
                }
            })
        </script>


        {{-- order edit drop down --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.edit-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var orderId = this.getAttribute('data-order-id');
                        toggleEditOptions(orderId);
                    });
                });

                function toggleEditOptions(orderId) {
                    var editOptionsRow = document.getElementById('edit-options-' + orderId);
                    if (editOptionsRow) {
                        if (editOptionsRow.style.display === 'none') {
                            editOptionsRow.style.display = 'table-row';
                        } else {
                            editOptionsRow.style.display = 'none';
                        }

                        hideOtherEditOptions(orderId);
                    }
                }
            });
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
