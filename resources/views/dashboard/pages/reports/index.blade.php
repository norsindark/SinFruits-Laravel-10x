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

                            {{-- title --}}
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6>Reports Table:
                                    </h6>
                                </div>
                            </div>


                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    @if ($reports && count($reports) > 0)
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
                                                        Orders ID
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        User Email
                                                    </th>
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                        Created At
                                                    </th>
                                                    <th
                                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Actions
                                                    </th>
                                                </tr>

                                            </thead>


                                            <tbody>
                                                @foreach ($reports as $item)
                                                    <tr>

                                                        {{-- id --}}
                                                        <td>{{ $item->id }}</td>

                                                        {{-- order id --}}
                                                        <td>{{ $item->order->id }}</td>

                                                        {{-- user email --}}
                                                        <td>{{ $item->order->user->email }}</td>

                                                        {{-- report created at --}}
                                                        <td>{{ $item->created_at }}</td>


                                                        {{-- action --}}
                                                        <td class="text-center">
                                                            <a class="btn btn-link text-dark px-3 mb-0 view-btn"
                                                                href="#" data-report-id="{{ $item->id }}">
                                                                <i class="fas fa-eye text-dark me-2"></i>View Reason
                                                            </a>

                                                        </td>


                                                    </tr>


                                                    {{-- view reason drop down --}}
                                                    @include('dashboard.pages.reports.view-reason')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No Report found.</p>
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


            </div>
        </div>

        {{-- view reason drop down --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.view-btn').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var reportId = this.getAttribute('data-report-id');
                        toggleEditOptions(reportId);
                    });
                });

                function toggleEditOptions(reportId) {
                    var editOptionsRow = document.getElementById('view-options-' + reportId);
                    if (editOptionsRow) {
                        if (editOptionsRow.style.display === 'none') {
                            editOptionsRow.style.display = 'table-row';
                        } else {
                            editOptionsRow.style.display = 'none';
                        }
                        hideOtherEditOptions(reportId);
                    }
                }
            });
        </script>
    </body>
@endsection
