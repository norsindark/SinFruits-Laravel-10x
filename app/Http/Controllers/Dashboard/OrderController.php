<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderCancellation;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.orders.index');
    }


    // update status
    public function confirmOrder(Request $request, $orderId)
    {
        $item = Order::find($orderId);

        if (!$item) {
            return redirect()->back()->with('error', 'Order not found');
        }

        $action = $request->input('action');

        switch ($action) {
            case 'Processing':
                $item->status = 1;
                break;
            case 'Paid':
                $item->status = 2;
                break;
            case 'Completed':
                $item->status = 5;
                break;
            case 'Cancel':
                $item->status = 4;
                $report = OrderCancellation::where('order_id', $orderId)->first();

                if ($report) {
                    $report->status = 1;
                    $report->save();
                }
                break;
            default:
                $item->status = 0;
        }

        $item->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    }
}
