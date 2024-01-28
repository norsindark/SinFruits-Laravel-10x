{{-- Orders --}}
<div class="tab-pane fade" id="orders" role="tabpanel">
    <div class="myaccount-content">
        <h3>Orders</h3>
        <div class="myaccount-table table-responsive text-center">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Order details --}}
                    @php $count = 1; @endphp
                    @foreach ($orders as $item)
                        <tr>
                            {{-- id --}}
                            <td>IC {{ $item->id }}</td>

                            {{-- created at --}}
                            <td>{{ $item->created_at }}</td>

                            {{-- status --}}
                            <td>
                                {{ ['Pending', 'Processing', 'Confirm Paid', 'Pending Cancellation', 'Canceled', 'Completed', 'Unknown Status'][
                                    $item->status
                                ] }}
                            </td>

                            {{-- total amount --}}
                            <td>
                                {{ number_format($item->total_amount, 0, '.', '.') }} VNĐ
                            </td>

                            {{-- action --}}
                            <td>
                                <a href="#" class="btn obrien-button-2 primary-color rounded-0 view-btn"
                                    data-order-id="{{ $item->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="#" class="btn obrien-button-2 primary-color rounded-0 buy-again-link"
                                    data-form-id="{{ $count }}"><i class="fa-solid fa-basket-shopping"></i></a>

                                <form action="{{ route('client.orders.buyAgain', $item) }}" method="POST"
                                    class="buy-again-form" data-form-id="{{ $count }}" style="display: none;">
                                    @csrf
                                </form>

                                @if ($item->status === 0)
                                    <button class="btn obrien-button-2 primary-color rounded-0"
                                        onclick="toggleCancelReasonSection({{ $item->id }})">
                                        Cancel
                                    </button>
                                @else
                                    <span class=" btn obrien-button-2 primary-color rounded-0"><i
                                            class="fa-solid fa-ban"></i>
                                    </span>
                                @endif
                            </td>


                            {{-- drop down action --}}
                        <tr>
                            <td colspan="5">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            {{-- Bootstrap Progress Bar --}}
                                            <div class="progress">
                                                @php
                                                    $progressColor = $item->status === 3 || $item->status === 4 ? 'bg-danger' : 'bg-success';
                                                @endphp
                                                <div class="progress-bar progress-bar-striped {{ $progressColor }}"
                                                    role="progressbar" style="width: {{ ($item->status + 1) * 20 }}%"
                                                    aria-valuenow="{{ ($item->status + 1) * 20 }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                    {{ ['Pending', 'Processing', 'Confirm Paid', 'Pending Cancellation', 'Canceled', 'Completed', 'Unknown Status'][$item->status] }}
                                                </div>
                                            </div>

                                            <span style="font-size: 12px">Updated at:
                                                {{ $item->updated_at->format('d-m H:i') }}</span>

                                            {{-- Cancellation Reason Section --}}
                                            <div id="cancelReasonSection{{ $item->id }}" style="display: none;">
                                                <label for="cancelReason{{ $item->id }}">Reason
                                                    for Cancellation:</label>
                                                <textarea id="cancelReason{{ $item->id }}" name="cancelReason" rows="4" class="form-control"></textarea>
                                                <button class="btn obrien-button-2 primary-color rounded-0"
                                                    onclick="confirmCancellation({{ $item->id }})">
                                                    Confirm Cancel
                                                </button>

                                            </div>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>

                        {{-- Order items drop-down --}}
                        <tr class="order-items-row" id="order-items-{{ $item->id }}" style="display: none;">
                            <td colspan="5">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Title</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($item->orderItems as $orderItem)
                                            <tr>
                                                <td>SKU:
                                                    {{ $orderItem->product->id }}
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ route('client.product.details', $orderItem->product->title) }}">
                                                        @php
                                                            $imagePath = $orderItem->product->productImages->isNotEmpty() ? asset($orderItem->product->productImages->first()->image_path) : asset('path_to_default_image/default_image.jpg');
                                                        @endphp
                                                        <img src="{{ $imagePath }}" alt="Product Image"
                                                            class="img-fluid" height="50px" width="50px">
                                                    </a>
                                                </td>

                                                <td>{{ $orderItem->product->name }}
                                                </td>
                                                <td>{{ $orderItem->quantity }}
                                                </td>
                                                <td>{{ number_format($orderItem->unit_price, 0, '.', '.') }}
                                                    VNĐ</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        @php $count++; @endphp
                    @endforeach

                </tbody>
            </table>
        </div>
        {{-- pagination --}}
        <div style="padding: 0px 120px; margin-top:24px;">
            {{ $orders->links('vendor.pagination.bootstrap-5') }}
        </div>
        {{-- pagination --}}
    </div>
</div>
