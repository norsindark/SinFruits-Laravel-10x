<?php

return [
    'tmnCode' => env('VNP_TMN_CODE', 'XLCLJLDH'), 
    'hashSecret' => env('VNP_HASH_SECRET', 'KMVUPCQKWENIXMYAWYMCXBKKYPJLDKEU'), 
    'url' => env('VNP_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
    'returnUrl' => env('VNP_RETURN_URL', 'http://127.0.0.1:8000//payments/vnpay/response'),
    'apiUrl' => env('VNP_API_URL', 'http://sandbox.vnpayment.vn/merchant_webapi/merchant.html'),
];
