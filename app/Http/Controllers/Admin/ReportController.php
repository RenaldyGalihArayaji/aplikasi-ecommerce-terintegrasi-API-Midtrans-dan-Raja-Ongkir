<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Transaksi;
use App\Models\OrderDetail;
use App\Exports\SalesExport;
use Illuminate\Http\Request;
use App\Exports\FinanceExport;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function sales()
    {
        return view('admin.reports.sales', ['title' => 'Report-Sales']);
    }

    public function salesData(Request $request)
    {
        $salesStart = $request->input('salesStart');
        $salesEnd = $request->input('salesEnd');

        // Sesuaikan query sesuai kebutuhan Anda
        $salesData = Order::with('product')
            ->whereBetween('created_at', [$salesStart . ' 00:00:00', $salesEnd . ' 23:59:59'])
            ->latest()->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.reports.sales-print', ['title' => 'Report-Sales', 'salesData' => $salesData]);
        return $pdf->download('sales-report' . '-' . Carbon::now() . '.pdf');
    }

    public function print($salesStart, $salesEnd)
    {
        $salesData = Order::with('product')
            ->whereBetween('created_at', [$salesStart . ' 00:00:00', $salesEnd . ' 23:59:59'])
            ->latest()->get();
        return view('admin.reports.sales-print', ['title' => 'Report-Sales', 'salesData' => $salesData]);
    }

    public function excelSales($salesStart, $salesEnd)
    {
        return Excel::download(new SalesExport($salesStart, $salesEnd), 'sales-export' . '-' . Carbon::now() . '.xlsx');
    }


    public function finance()
    {
        return view('admin.reports.finance', ['title' => 'Report-Finance']);
    }

    public function financeData(Request $request)
    {
        $financeStart = $request->input('financeStart');
        $financeEnd = $request->input('financeEnd');

        // Sesuaikan query sesuai kebutuhan Anda
        $financeData = Transaksi::whereBetween('created_at', [$financeStart . ' 00:00:00', $financeEnd . ' 23:59:59'])
            ->where('status_payment', 'paid')->latest()->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.reports.finance-print', ['title' => 'Report-finance', 'financeData' => $financeData]);
        return $pdf->download('finance-report' . '-' . Carbon::now() . '.pdf');
    }

    public function printFinance($financeStart, $financeEnd)
    {
        $financeData = Transaksi::whereBetween('created_at', [$financeStart . ' 00:00:00', $financeEnd . ' 23:59:59'])
            ->where('status_payment', 'paid')->latest()->get();
        return view('admin.reports.finance-print', ['title' => 'Report-finance', 'financeData' => $financeData]);
    }

    public function excelFinance($financeStart, $financeEnd)
    {
        return Excel::download(new FinanceExport($financeStart, $financeEnd), 'finance-export' . '-' . Carbon::now() . '.xlsx');
    }
}
