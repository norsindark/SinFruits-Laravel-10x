<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;

class ReportController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.reports.index');
    }

    public function exportRevenueReport()
    {
        $orders = Order::all();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <ss:Workbook xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">
            <ss:Worksheet ss:Name="Sheet1">
                <ss:Table>';

        $xml .= '<ss:Row>
            <ss:Cell><ss:Data ss:Type="String">ID</ss:Data></ss:Cell>
            <ss:Cell><ss:Data ss:Type="String">User ID</ss:Data></ss:Cell>
            <ss:Cell><ss:Data ss:Type="String">Total Amount</ss:Data></ss:Cell>
            <ss:Cell><ss:Data ss:Type="String">Address</ss:Data></ss:Cell>
            <ss:Cell><ss:Data ss:Type="String">Phone</ss:Data></ss:Cell>
            <ss:Cell><ss:Data ss:Type="String">Email</ss:Data></ss:Cell>
            <ss:Cell><ss:Data ss:Type="String">Notes</ss:Data></ss:Cell>
            <ss:Cell><ss:Data ss:Type="String">Full Name</ss:Data></ss:Cell>
        </ss:Row>';

        foreach ($orders as $order) {
            $xml .= '<ss:Row>
                <ss:Cell><ss:Data ss:Type="Number">' . $order->id . '</ss:Data></ss:Cell>
                <ss:Cell><ss:Data ss:Type="Number">' . $order->user_id . '</ss:Data></ss:Cell>
                <ss:Cell><ss:Data ss:Type="Number">' . $order->total_amount . '</ss:Data></ss:Cell>
                <ss:Cell><ss:Data ss:Type="String">' . $order->address . '</ss:Data></ss:Cell>
                <ss:Cell><ss:Data ss:Type="String">' . $order->phone . '</ss:Data></ss:Cell>
                <ss:Cell><ss:Data ss:Type="String">' . $order->email . '</ss:Data></ss:Cell>
                <ss:Cell><ss:Data ss:Type="String">' . $order->notes . '</ss:Data></ss:Cell>
                <ss:Cell><ss:Data ss:Type="String">' . $order->full_name . '</ss:Data></ss:Cell>
            </ss:Row>';
        }

        $xml .= '</ss:Table>
        </ss:Worksheet>
    </ss:Workbook>';

        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename="revenue_report_' . date('Y-m-d') . '.xls"',
        ];

        return response($xml, 200, $headers);
    }
}
