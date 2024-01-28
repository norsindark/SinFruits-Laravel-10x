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
                                <div class="section-content text-center mb-5">
                                    <h2 class="title-4 mb-2">SELECT A PAYMENT METHOD</h2>
                                </div>

                                {{-- PAYMENTS --}}
                                <div class="form-group">
                                    <button type="button" class= "btn obrien-button-2 primary" onclick="pay()">
                                        <img style="max-height: 100px; max-width: 100px;"
                                            src="{{ asset('/assets/images/Logo-VNPAY-QR.png') }}" alt="">
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function pay() {
                window.location.href = "{{ route('client.payments.create') }}";
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
@endsection
