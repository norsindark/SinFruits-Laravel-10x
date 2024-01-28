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
                                <h3 class="title-3">Payment</h3>
                                <ul>
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li>Success</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="login-register-area mt-no-text mb-no-text">
                <div class="container container-default-2 custom-area">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                            <div class="login-register-wrapper">
                                <div class="container">
                                    <div class="table-responsive" style="margin-top: 12px">
                                        <!--Begin display -->
                                        <div class="container">
                                            <div class="header clearfix">
                                                <h3 class="text-muted" style="font-size: 28px;">VNPAY RESPONSE</h3>
                                            </div>
                                            <div class="table-responsive">
                                                <div class="form-group" style="font-size: 18px;">
                                                    <label>ORDER ID:</label> &nbsp;
                                                    <label>{{ $inputData['vnp_TxnRef'] }}</label>
                                                </div>
                                                <div class="form-group" style="font-size: 18px;">
                                                    <label>TOTAN AMOUNT:</label> &nbsp;
                                                    <label>{{ $inputData['vnp_Amount'] }}</label>
                                                </div>
                                                <div class="form-group" style="font-size: 18px;">
                                                    <label>CONTENT BILLING:</label> &nbsp;
                                                    <label>{{ $inputData['vnp_OrderInfo'] }}</label>
                                                </div>
                                                <div class="form-group" style="font-size: 18px;">
                                                    <label>GD CODE AT VNPAY:</label> &nbsp;
                                                    <label>{{ $inputData['vnp_TransactionNo'] }}</label>
                                                </div>
                                                <div class="form-group" style="font-size: 18px;">
                                                    <label>BANK CODE:</label> &nbsp;
                                                    <label>{{ $inputData['vnp_BankCode'] }}</label>
                                                </div>
                                                <div class="form-group" style="font-size: 18px;">
                                                    <label>PAID TIME:</label> &nbsp;
                                                    <label>{{ \Carbon\Carbon::createFromFormat('YmdHis', $inputData['vnp_PayDate'])->format('Y-m-d H:i:s') }}</label>
                                                </div>
                                                <div class="form-group" style="font-size: 18px;">
                                                    <label>RESULT:</label> &nbsp;
                                                    <label>
                                                        @if ($secureHash == $vnp_SecureHash)
                                                            @if ($inputData['vnp_ResponseCode'] == '00')
                                                                <span style='color:blue'>successful transaction</span>
                                                            @else
                                                                <span style='color:red'>transaction failed</span>
                                                            @endif
                                                        @else
                                                            <span style='color:red'>Invalid signature</span>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>

                                            <p>
                                                &nbsp;
                                            </p>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </body>
@endsection
