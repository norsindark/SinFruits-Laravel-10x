<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RevenueReportExport;

class ReportController extends Controller
{
    public function index() {
        return view('dashboard.pages.reports.index');
    }

    public function exportRevenueReport()
    {
        $revenueData = Order::select('created_at', 'total_amount')->get();
        // return Excel::download(new RevenueReportExport($revenueData), 'revenue_report.xlsx');
    }
}
