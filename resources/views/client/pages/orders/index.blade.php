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
                    @foreach ($orders as $item)
                        <tr>
                            {{-- id --}}
                            <td>IC {{ $item->id }}</td>

                            {{-- created at --}}
                            <td>{{ $item->created_at }}</td>

                            {{-- status --}}
                            <td>
                                {{ $item->status === 0
                                    ? 'Pending'
                                    : ($item->status === 1
                                        ? 'Processing'
                                        : ($item->status === 2
                                            ? 'Completed'
                                            : ($item->status === 3
                                                ? 'Pending Cancellation'
                                                : ($item->status === 4
                                                    ? 'Canceled'
                                                    : 'Unknown Status')))) }}
                            </td>

                            {{-- total amount --}}
                            <td>
                                {{ number_format($item->total_amount, 0, '.', '.') }} VNĐ
                            </td>

                            {{-- action --}}
                            <td>
                                <a href="#" class="btn obrien-button-2 primary-color rounded-0 view-btn"
                                    data-order-id="{{ $item->id }}">
                                    View
                                </a>
                                @if ($item->status === 0)
                                    <button class="btn obrien-button-2 primary-color rounded-0"
                                        onclick="toggleCancelReasonSection({{ $item->id }})">
                                        Cancel
                                    </button>
                                @else
                                    <span class="fa-solid fa-ban btn btn obrien-button-2 primary-color rounded-0">
                                    </span>
                                @endif
                            </td>

                        <tr>
                            <td colspan="5">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
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
                                                    <a href="{{ route('client.product.details', $item->id) }}">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
