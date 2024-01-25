{{-- title --}}
<div class="card-header pb-0">
    <div class="d-flex justify-content-between align-items-center">
        <h6>Reports Table: Pending
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
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            ID
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Orders ID
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            User Email
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Created At
                        </th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Status
                        </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Actions
                        </th>
                    </tr>

                </thead>


                <tbody>
                    @foreach ($reports as $item)
                        @if ($item->status == 0)
                            <tr>
                                {{-- id --}}
                                <td>{{ $item->id }}</td>

                                {{-- order id --}}
                                <td>{{ $item->order->id }}</td>

                                {{-- user email --}}
                                <td>{{ $item->order->user->email }}</td>

                                {{-- report created at --}}
                                <td>{{ $item->created_at }}</td>

                                {{-- status --}}
                                <td>{{ ['Pending', 'Processed', 'Unknown Status'][$item->status] }}
                                </td>


                                {{-- action --}}
                                <td class="text-center">
                                    <a class="btn btn-link text-dark px-3 mb-0 pending-btn" href="#"
                                        data-report-id="{{ $item->id }}">
                                        <i class="fas fa-eye text-dark me-2"></i>View Reason
                                    </a>


                                </td>
                            </tr>
                        @endif
                        {{-- view reason drop down --}}
                        {{-- @include('dashboard.pages.reports.view-reason') --}}
                        <tr class="view-items-row text-center" style="display: none;"
                            id="pending-options-{{ $item->id }}">
                            <td colspan="6">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            ID Report
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Cancel Reason
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td class="text-center">
                                                <span data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $item->first()->cancel_reason }}"
                                                    style="display: inline-block; max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    {{ \Illuminate\Support\Str::limit($item->first()->cancel_reason, 100, $end = '...') }}
                                                </span>
                                            </td>
                                            <td>
                                                {{-- Cancel --}}
                                                <a href="javascript:;"
                                                    class="btn btn-link text-danger text-gradient px-3 mb-0 confirm-action"
                                                    data-action="Cancel" data-order-id="{{ $item->order->id }}">
                                                    <i class="far fa-trash-alt me-2"></i>Submit Cancel
                                                </a>
                                                {{-- form submit --}}
                                                <form id="confirmForm{{ $item->order->id }}"
                                                    action="{{ route('dashboard.orders.confirm', $item->order->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="action"
                                                        id="confirmAction{{ $item->order->id }}">
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
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
