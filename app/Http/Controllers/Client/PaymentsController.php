<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Client\OrdersController;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductWarehouse;
use Illuminate\Support\Facades\Validator;


class PaymentsController extends Controller
{
    // index
    public function index()
    {
        return view('client.pages.vnpay_php.index');
    }


    // show form create
    public function create(Order $order)
    {
        return view('client.pages.vnpay_php.vnpay_pay', compact('order'));
    }


    // store
    public function createPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'order_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cartId = Cart::where('user_id', auth()->user()->id)->first()->id;

        $cartItems = CartItem::where('cart_id', $cartId)->get();

        foreach ($cartItems as $item) {
            $productWarehouse = ProductWarehouse::where('product_id', $item->product_id)->first();

            if ($productWarehouse->quantity < $item->quantity) {
                return redirect()->back()->with('error', 'Not enough quantity in the warehouse for product: ' . $item->product->name);
            }
        }


        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $request->session()->put('checkout_data', $request->all());

        $lastOrderId = Order::max('id');
        $newOrderId = $lastOrderId + 1;


        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+5 minutes', strtotime($startTime)));

        // dd($startTime);


        $vnp_TmnCode = config('vnpay.tmnCode');
        $vnp_HashSecret = config('vnpay.hashSecret');
        $vnp_Url = config('vnpay.url');
        $vnp_Returnurl = config('vnpay.returnUrl');
        $vnp_apiUrl = config('vnpay.apiUrl');

        $vnp_TxnRef = $newOrderId;
        $vnp_Amount = $_POST['amount'];
        $vnp_Locale = $_POST['language'];
        $vnp_BankCode = $_POST['bankCode'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect()->away($vnp_Url);
    }


    // response
    public function vnpayResponse(Request $request, OrdersController $ordersController)
    {

        $vnp_TmnCode = config('vnpay.tmnCode');
        $vnp_HashSecret = config('vnpay.hashSecret');
        $vnp_Url = config('vnpay.url');
        $vnp_Returnurl = config('vnpay.returnUrl');
        $vnp_apiUrl = config('vnpay.apiUrl');

        $vnp_SecureHash = $request->input('vnp_SecureHash');

        $inputData = [];
        foreach ($request->input() as $key => $value) {
            if (substr($key, 0, 4) == 'vnp_') {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = '';
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $data = [
            'secureHash' => $secureHash,
            'inputData' => $inputData,
            'vnp_SecureHash' => $vnp_SecureHash,
        ];

        if (isset($inputData['vnp_ResponseCode']) && isset($vnp_SecureHash)) {
            if ($inputData['vnp_ResponseCode'] == '00' && $secureHash == $vnp_SecureHash) {
                // $checkoutData = session('checkout_data');
                // dd($checkoutData);
                // $ordersController->create(new Request($checkoutData));
                $ordersController->create();
            }
        }

        return view('client.pages.vnpay_php.response', $data)->with('success', 'PAYMENT SUCCESSFULLY!');
    }



    //notify
    public function vnpayNotify(Request $request)
    {
        $inputData = $request->input();

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);

        $vnp_HashSecret = config('vnpay.hashSecret');

        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        $Status = 0;

        try {

            $returnData = [
                'RspCode' => '00',
                'Message' => 'Confirm Success',
            ];
        } catch (\Exception $e) {
            $returnData = [
                'RspCode' => '99',
                'Message' => 'Unknown error',
            ];
        }

        if ($secureHash == $vnp_SecureHash) {
            return response()->json($returnData);
        } else {
            return response()->json([
                'RspCode' => '97',
                'Message' => 'Invalid signature',
            ]);
        }
    }
}
