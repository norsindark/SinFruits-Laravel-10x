<tr class="order-items-row" style="display: none;" id="order-items-{{ $item->id }}">
    <td colspan="6">
        <table class="table align-items-center mb-0">
            <h6 class="table text-center mb-0">Order Items Table</h6>
            <thead>
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
                                <img src="{{ $imagePath }}" alt="Product Image" class="img-fluid" height="50px"
                                    width="50px">
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
