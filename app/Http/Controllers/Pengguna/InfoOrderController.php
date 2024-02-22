<?php

namespace App\Http\Controllers\Pengguna;

use App\Models\Order;
use App\Models\Transaksi;
use App\Models\DataCustomer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InfoOrderController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::where('user_id', Auth::user()->id)->latest()->get();
        return view('landing.info-orders.index', ['title' => 'payment'], compact('transaksi',));
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        return redirect()->back();
    }

    public function show($id)
    {
        $transaksi = Transaksi::where('user_id', Auth::user()->id)->find($id);
        $order = Order::with('product')->where('invoice', $transaksi->invoice)->where('user_id', Auth::user()->id)->get();
        $dataCustomer = DataCustomer::with(['province', 'city'])->where('invoice', $transaksi->invoice)->where('user_id', Auth::user()->id)->first();
        return view('landing.info-orders.show', ['title' => 'payment'], compact('dataCustomer', 'transaksi', 'order'));
    }
}
