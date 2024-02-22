<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FinanceExport implements FromView
{
    protected $financeStart;
    protected $financeEnd;

    public function __construct($financeStart, $financeEnd)
    {
        $this->financeStart = $financeStart;
        $this->financeEnd = $financeEnd;
    }

    public function view(): View
    {
        $financeData = Transaksi::whereBetween('created_at', [$this->financeStart . ' 00:00:00', $this->financeEnd . ' 23:59:59'])
            ->where('status_payment', 'paid')->latest()->get();

        return view('admin.reports.finance-print', [
            'financeData' => $financeData,
        ]);
    }
}
