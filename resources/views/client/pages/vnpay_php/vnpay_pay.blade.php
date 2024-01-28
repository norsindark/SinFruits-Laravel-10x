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
                                <h3 class="title-3">PAYMENT</h3>
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>PAYMENT</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Login Area Start Here -->
            <div class="login-register-area mt-no-text mb-no-text">
                <div class="container container-default-2 custom-area">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                            <div class="login-register-wrapper">
                                <div class="container">
                                    <h4 class="mt-5">CREATE NEW ORDERS</h4>
                                    <div class="table-responsive" style="margin-top: 12px">
                                        <form action="{{ route('client.payments.createPayment') }}" id="payForm"
                                            method="post">
                                            @csrf
                                            {{-- <input type="hidden" name="order_id" value="{{ $order->id }}"> --}}
                                            <div class="form-group">
                                                <label for="amount">Total money</label>
                                                <div class="input-group">
                                                    <input class="form-control" data-val="true"
                                                        data-val-number="The field Amount must be a number."
                                                        data-val-required="The Amount field is required." id="amount"
                                                        max="100000000" min="1" name="amount" type="number"
                                                        value="{{ number_format($total, 0, '', '') }}"  />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">VNĐ</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <h5 style="margin-top: 12px">Select a payment method</h5>
                                            <div class="form-group" style="margin-top: 12px">
                                                {{-- <h6>Cách 1: Chuyển hướng sang Cổng VNPAY chọn phương thức thanh toán</h6> --}}
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" checked="true"
                                                        id="bankCode1" name="bankCode" value="">
                                                    <label class="form-check-label" for="bankCode1">VNPAYQR payment
                                                        gateway</label>
                                                </div>
                                                {{-- <h6 style="margin-top: 12px">Cách 2: Tách phương thức tại site của đơn vị kết nối</h6> --}}
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="bankCode2"
                                                        name="bankCode" value="VNPAYQR">
                                                    <label class="form-check-label" for="bankCode2">Pay with applications
                                                        that support VNPAY QR</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="bankCode3"
                                                        name="bankCode" value="VNBANK">
                                                    <label class="form-check-label" for="bankCode3">Payment via card
                                                        ATM/Fin
                                                        domestic account</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="bankCode4"
                                                        name="bankCode" value="INTCARD">
                                                    <label class="form-check-label" for="bankCode4">Payment via national
                                                        card
                                                        international</label>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-top: 12px">
                                                <h6>Select payment interface language:</h6>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" checked="true"
                                                        id="language1" name="language" value="vn">
                                                    <label class="form-check-label" for="language1">Vietnamese</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="language2"
                                                        name="language" value="en">
                                                    <label class="form-check-label" for="language2">English</label>
                                                </div>
                                            </div>
                                            {{-- <button style="margin-top: 12px" type="button"
                                                class= "btn obrien-button-2 primary-color">Pay</button> --}}
                                            <div class="order-button-payment">
                                                <input value="Pay" onclick="confirmPay()" readonly>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- submit place order --}}
        <script>
            function confirmPay() {
                if (confirm('Are you sure you want to Pay?')) {
                    document.getElementById('payForm').submit();
                }
            }
        </script>

        <script>
            var vnp_TmnCode = "<?php echo config('vnpay.tmnCode'); ?>";
            var vnp_HashSecret = "<?php echo config('vnpay.hashSecret'); ?>";
            var vnp_Url = "<?php echo config('vnpay.url'); ?>";
            var vnp_Returnurl = "<?php echo config('vnpay.returnUrl'); ?>";
            var vnp_apiUrl = "<?php echo config('vnpay.apiUrl'); ?>";
        </script>


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
