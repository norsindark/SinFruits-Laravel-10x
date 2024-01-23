@extends('client.layouts.master')

@section('content')

    <body>

        <div class="contact-wrapper">

            <!-- Breadcrumb Area Start Here -->
            <div class="breadcrumbs-area position-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="breadcrumb-content position-relative section-content">
                                <h3 class="title-3">Shopping Cart</h3>
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Cart</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            {{-- Main Cart  --}}
            <div class="cart-main-wrapper mt-no-text mb-no-text">
                <div class="container container-default-2 custom-area">
                    <div class="row">
                        <div class="col-lg-12">


                            {{-- Cart Table  --}}
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
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

                                        <tr>
                                            <th class="pro-thumbnail">Image</th>
                                            <th class="pro-title">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalPrice = 0;
                                        @endphp
                                        @foreach ($cartItems as $item)
                                            <tr>


                                                {{-- image thumbnail --}}
                                                <td class="pro-thumbnail">

                                                    <a href="{{ route('client.product.details', $item->id) }}">
                                                        @php
                                                            $imagePath = $item->productImages->isNotEmpty() ? asset($item->productImages->first()->image_path) : asset('path_to_default_image/default_image.jpg');
                                                        @endphp
                                                        <img src="{{ $imagePath }}" alt="Product Image"
                                                            class="img-fluid">
                                                    </a>
                                                </td>


                                                {{-- title  --}}
                                                <td class="pro-title">
                                                    <a href="#">
                                                        {{ $item->name }}
                                                    </a>
                                                </td>


                                                {{-- price  --}}
                                                <td class="pro-price">
                                                    <span>
                                                        {{ number_format($item->product_details->price) }} VNĐ
                                                    </span>
                                                </td>


                                                {{-- update quantity  --}}
                                                <td class="pro-quantity">
                                                    <div class="quantity">
                                                        <form
                                                            action="{{ route('client.cart.updateQuantity', ['productId' => $item->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')

                                                            <div class="cart-plus-minus">
                                                                <input class="cart-plus-minus-box quantity-input"
                                                                    value="{{ $item->pivot->quantity }}" type="text"
                                                                    name="quantity">
                                                                <div class="dec qtybutton">-</div>
                                                                <div class="inc qtybutton">+</div>
                                                                <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                                <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                                            </div>
                                                            <button type="submit" style="color:black;"><i class="fa fa-save"> save</i></button>
                                                        </form>
                                                    </div>
                                                </td>




                                                {{-- sub total  --}}
                                                <td class="pro-subtotal">
                                                    <span>{{ number_format($item->product_details->price * $item->pivot->quantity, 0, '.', '.') }}
                                                        VNĐ</span>
                                                    @php
                                                        $totalPrice += $item->product_details->price * $item->pivot->quantity;
                                                    @endphp
                                                </td>


                                                {{-- remove product  --}}
                                                <td class="pro-remove">
                                                    <a href="javascript:void(0);" class="remove-from-cart"
                                                        data-product-id="{{ $item->id }}">
                                                        <i class="ion-trash-b"></i>
                                                    </a>
                                                </td>


                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                            {{-- Coupon  --}}
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="apply-coupon-wrapper">
                                    <form action="#" method="post" class=" d-block d-md-flex">
                                        <input type="text" placeholder="Enter Your Coupon Code" required />
                                        <button class="btn obrien-button primary-btn">Apply Coupon</button>
                                    </form>
                                </div>
                                <div class="cart-update mt-sm-16">
                                    <a href="#" class="btn obrien-button primary-btn">Update Cart</a>
                                </div>
                            </div>
                            {{-- Coupon  --}}


                        </div>
                    </div>


                    {{-- Cart Total  --}}
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h3>Cart Totals</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Sub Total</td>
                                                <td>{{ number_format($subTotal, 0, '.', '.') }} VNĐ</td>
                                            </tr>
                                            <tr>
                                                <td>VAT(10%)</td>
                                                <td>{{ number_format($vat, 0, '.', '.') }} VNĐ</td>
                                            </tr>
                                            <tr class="total">
                                                <td>Total</td>
                                                <td class="total-amount">{{ number_format($total, 0, '.', '.') }} VNĐ</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="{{ url('checkout') }}" class="btn obrien-button primary-btn d-block">
                                    Proceed To Checkout
                                </a>
                            </div>
                        </div>
                    </div>




                </div>
            </div>


            <!-- Support Area Start Here -->
            <div class="support-area">
                <div class="container container-default custom-area">
                    <div class="row">
                        <div class="col-lg-12 col-custom">
                            <div class="support-wrapper d-flex">
                                <div class="support-content">
                                    <h1 class="title">Need Help ?</h1>
                                    <p class="desc-content">Call our support 24/7 at 01234-567-890</p>
                                </div>
                                <div class="support-button d-flex align-items-center">
                                    <a class="obrien-button primary-btn" href="contact-us.html">Contact now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        {{-- remove item  --}}
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.remove-from-cart').on('click', function() {
                    var productId = $(this).data('product-id');

                    // Hộp thoại xác nhận
                    var isConfirmed = confirm('Are you sure you want to remove this product from the cart?');

                    if (isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('client.cart.remove') }}',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'product_id': productId
                            },
                            success: function(data) {
                                // Xử lý sau khi sản phẩm được xóa thành công
                                location.reload();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });
        </script>


    </body>
@endsection
