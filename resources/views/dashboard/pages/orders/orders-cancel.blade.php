{{-- Titel --}}
<div class="card-header pb-0">
    <div class="d-flex justify-content-between align-items-center">
        <h6>Orders Table: Pending Cancellation</h6>
    </div>
</div>

<div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
        @if ($billOrders && count($billOrders) > 0)
            <table class="table align-items-center mb-0">
                <thead>

                    {{-- title menu --}}
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            ID
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            User Email
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Date
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Status
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Total
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Actions
                        </th>
                    </tr>

                </thead>


                <tbody>

                    @foreach ($billOrders as $item)
                        @if ($item->status == 3)
                            <tr>
                                {{-- id --}}
                                <td>IC {{ $item->id }}</td>

                                {{-- user email --}}
                                <td>{{ $item->user->email }}</td>

                                {{-- order created at --}}
                                <td>{{ $item->created_at }}</td>

                                {{-- status --}}
                                <td>{{ ['Pending', 'Processing', 'Confirm Paid', 'Pending Cancellation', 'Canceled', 'Completed', 'Unknown Status'][$item->status] }}
                                </td>

                                {{-- price --}}
                                <td>{{ number_format($item->total_amount, 0, '.', '.') }} VNĐ</td>


                                {{-- action --}}
                                <td class="text-center">
                                    <a class="btn btn-link text-dark px-3 mb-0 view-btn" href="#"
                                        data-order-id="{{ $item->id }}">
                                        <i class="fas fa-eye text-dark me-2"></i>View
                                    </a>

                                    <a class="btn btn-link text-dark px-3 mb-0 view-btn" href="#"
                                        data-report-id="{{ $item->id }}">
                                        <i class="fas fa-eye text-dark me-2"></i>Reason
                                    </a>

                                    {{-- <a href="#" class="btn btn-link text-dark px-3 mb-0 edit-btn"
                                        data-order-id="{{ $item->id }}">
                                        <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Update
                                    </a> --}}
                                </td>


                            </tr>

                            {{-- view reason drop down --}}
                            @include('dashboard.pages.orders.view-reason')


                            {{-- edit status drop down --}}
                            @include('dashboard.pages.orders.edit-status')


                            {{-- Order items drop-down --}}
                            @include('dashboard.pages.orders.order-drop-down')
                        @else
                        @endif
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
