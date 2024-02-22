<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesExport implements FromView
{
    protected $salesStart;
    protected $salesEnd;

    public function __construct($salesStart, $salesEnd)
    {
        $this->salesStart = $salesStart;
        $this->salesEnd = $salesEnd;
    }

    public function view(): View
    {
        $salesData = Order::with('product')
            ->whereBetween('created_at', [$this->salesStart . ' 00:00:00', $this->salesEnd . ' 23:59:59'])
            ->latest()->get();

        return view('admin.reports.sales-print', [
            'salesData' => $salesData,
        ]);
    }
}
