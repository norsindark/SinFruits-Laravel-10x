@extends('client.layouts.master')

@section('content')

    <body>

        <div class="contact-wrapper">


            {{-- Breadcrumb --}}
            <div class="breadcrumbs-area position-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="breadcrumb-content position-relative section-content">
                                <h3 class="title-3">Checkout</h3>
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Checkout</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Check out --}}
            <div class="checkout-area">
                <div class="container container-default-2 custom-container">

                    {{-- Coupon --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-accordion">
                                <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                                <div id="checkout_coupon" class="coupon-checkout-content">
                                    <div class="coupon-info">
                                        <form action="#">
                                            <p class="checkout-coupon">
                                                <input placeholder="Coupon code" type="text">
                                                <input class="coupon-inner_btn" value="Apply Coupon" type="submit">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- notification  --}}
                    <div class="row">
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
                    </div>


                    {{-- Check out details --}}
                    <div class="row">


                        {{-- User Details --}}

                        <div class="col-lg-6 col-12">
                            <form action="{{ route('client.payments.createPayment') }}" method="post" id="orderForm">

                                {{-- <form action="#" method="post" id="orderForm"> --}}
                                @csrf
                                <div class="checkbox-form">
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        {{-- Full name --}}
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Full Name <span class="required"></span></label>
                                                <input name="full_name" placeholder="" type="text"
                                                    value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>

                                        {{-- Address --}}
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <input name="address" placeholder="Your address" type="text"
                                                    value="{{ Auth::user()->address }}">
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email Address <span class="required">*</span></label>
                                                <input name="email" placeholder="" type="email"
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>

                                        {{-- Phone --}}
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Phone <span class="required">*</span></label>
                                                <input name="phone" type="text" placeholder="Your phone number"
                                                    value="{{ Auth::user()->phone }}">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Order Notes --}}
                                    <div class="different-address">
                                        <div class="order-notes mt-3">
                                            <div class="checkout-form-list checkout-form-list-2">
                                                <label>Order Notes</label>
                                                <textarea name="order_notes" id="checkout-mess" cols="30" rows="10"
                                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                        </div>
                        {{-- Orders --}}
                        <div class="col-lg-6 col-12">
                            <div class="your-order">
                                <h3>Your order</h3>
                                <div class="your-order-table table-responsive">


                                    {{-- Order Items --}}
                                    <table class="table">


                                        {{-- Item details  --}}
                                        <thead>
                                            <tr>
                                                <th class="cart-product-name">Product</th>
                                                <th class="cart-product-total">Total</th>
                                            </tr>
                                        </thead>


                                        {{-- Item details  --}}
                                        <tbody>
                                            @foreach ($cartItems as $item)
                                                <tr class="cart_item">

                                                    {{-- title --}}
                                                    <td class="cart-product-name"> {{ $item->name }}
                                                        <strong class="product-quantity">
                                                            x {{ $item->pivot->quantity }}
                                                        </strong>
                                                    </td>

                                                    {{-- total --}}
                                                    <td class="cart-product-total text-center">
                                                        <span class="amount">
                                                            {{ number_format($item->product_details->price * $item->pivot->quantity, 0, '.', '.') }}
                                                            VNĐ
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>

                                        {{-- Sub Total - Order Total --}}
                                        <tfoot>


                                            {{-- cart total --}}
                                            <tr class="cart-subtotal" style="margin-top: 24px !important;">
                                                <th>Cart Subtotal</th>
                                                <td class="text-center">
                                                    <Strong>
                                                        <span class="amount">
                                                            {{ number_format($subTotal, 0, '.', '.') }} VNĐ
                                                        </span>
                                                        {{-- @php
                                                                $totalPrice += $item->product_details->price * $item->pivot->quantity;
                                                            @endphp --}}
                                                    </Strong>
                                                </td>
                                            </tr>


                                            {{-- VAT --}}
                                            <tr class="cart-subtotal">
                                                <th>VAT(10%)</th>
                                                <td class="text-center">
                                                    <strong>{{ number_format($vat, 0, '.', '.') }} VNĐ
                                                    </strong>
                                                </td>
                                            </tr>


                                            {{-- order total --}}
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td class="text-center">
                                                    <strong>
                                                        <span class="amount">{{ number_format($total, 0, '.', '.') }}
                                                            VNĐ
                                                        </span>
                                                    </strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>


                                {{-- Payment method --}}
                                <div class="payment-method">
                                    <div class="payment-accordion">


                                        {{-- method --}}
                                        <div id="accordion">
                                            <div class="card">

                                                {{-- icon --}}
                                                <div class="card-header" id="#payment-1">
                                                    <h5 class="panel-title mb-2">
                                                        <a href="#" class="" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne" aria-expanded="true"
                                                            aria-controls="collapseOne">
                                                            <img style="max-height: 100px; max-width: 100px;"
                                                                src="{{ asset('/assets/images/Logo-VNPAY-QR.png') }}"
                                                                alt="">
                                                        </a>
                                                    </h5>
                                                </div>

                                                {{-- total amount --}}
                                                <input class="form-control" data-val="true"
                                                    data-val-number="The field Amount must be a number."
                                                    data-val-required="The Amount field is required." id="amount"
                                                    max="100000000" min="1" name="amount" type="number"
                                                    value="{{ number_format($total, 0, '', '') }}" readonly hidden />

                                                <h6>Select a payment method</h6>

                                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                    <div class="form-group" style="margin-top: 12px">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" checked="true"
                                                                id="bankCode1" name="bankCode" value="">
                                                            <label class="form-check-label" for="bankCode1">VNPAYQR
                                                                payment
                                                                gateway</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="bankCode2"
                                                                name="bankCode" value="VNPAYQR">
                                                            <label class="form-check-label" for="bankCode2">Pay with
                                                                applications
                                                                that support VNPAY QR</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="bankCode3"
                                                                name="bankCode" value="VNBANK">
                                                            <label class="form-check-label" for="bankCode3">Payment
                                                                via
                                                                card
                                                                ATM/Fin
                                                                domestic account</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="bankCode4"
                                                                name="bankCode" value="INTCARD">
                                                            <label class="form-check-label" for="bankCode4">Payment
                                                                via
                                                                national
                                                                card
                                                                international</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-top: 12px">
                                                        <h6>Select payment interface language:</h6>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" checked="true"
                                                                id="language1" name="language" value="vn">
                                                            <label class="form-check-label"
                                                                for="language1">Vietnamese</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="language2"
                                                                name="language" value="en">
                                                            <label class="form-check-label"
                                                                for="language2">English</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            {{-- Submit buy --}}
                                            @if ($cartItems->count() > 0)
                                                <div class="order-button-payment">
                                                    <input value="Place order" onclick="confirmPayment()" readonly>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>


                    <div class="row">
                        {{-- User Details --}}
                        <div class="col-lg-6 col-12">

                        </div>

                        {{-- Remaining content... --}}
                    </div>

                </div>
            </div>


        </div>

        {{-- submit place order --}}
        <script>
            function confirmPayment() {
                if (confirm('Are you sure you want to Place orders and Proceed with Payment?')) {
                    document.getElementById('orderForm').submit();
                }
            }
        </script>

        {{-- pay --}}
        {{-- <script>
            function pay() {
                window.location.href = "{{ route('client.payments.create') }}";
            }
        </script> --}}

    </body>

    <style>
        .order-button-payment input {
            background: #1B1B1C;
            border: medium none;
            color: #ffffff;
            font-size: 17px;
            height: 50px;
            margin: 20px 0 0;
            padding: 0;
            text-transform: uppercase;
            -webkit-transition: .3s;
            -o-transition: .3s;
            transition: .3s;
            width: 100%;
            border: 1px solid transparent;
            cursor: pointer;
            text-align: center;
        }
    </style>
@endsection
