<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SinFruits</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/jumbotron-narrow.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/jquery-1.11.3.min.js') }}"></script>
</head>

<body>
    @yield('content')

    <script>
        function pay() {
            window.location.href = "{{ route('client.payments.create') }}";
        }

        function querydr() {
            window.location.href = "/vnpay_php/vnpay_querydr.php";
        }

        function refund() {
            window.location.href = "/vnpay_php/vnpay_refund.php";
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

</html>
