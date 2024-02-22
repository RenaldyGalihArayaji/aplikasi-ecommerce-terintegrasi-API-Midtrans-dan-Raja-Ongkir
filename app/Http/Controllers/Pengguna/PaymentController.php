<?php

namespace App\Http\Controllers\Pengguna;

use App\Models\Order;
use App\Models\Transaksi;
use App\Models\OrderDetail;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function prosessToTransaksi()
    {
        $invoice = session('invoice');
        $order = Order::with('product')
            ->where('user_id', Auth::user()->id)
            ->where('invoice', $invoice)
            ->get();

        $ongkir = session('ongkir', 0);
        $subtotal = $order->sum('sub_total'); // Menggunakan sum() untuk menghitung subtotal dari semua item pesanan
        $total = $subtotal + $ongkir;

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.isProduction', false);
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized', true);
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is3ds', true);

        $params = [
            'transaction_details' => [
                'order_id' => $invoice,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        Transaksi::create([
            'invoice' => $invoice,
            'user_id' => Auth::user()->id,
            'sub_total_transaksi' => $subtotal,
            'grand_total' => $total,
            'shipping_cost' => $ongkir,
            'snap_token' => $snapToken,
        ]);

        return redirect()->route('payment');
    }

    public function index()
    {
        $invoice = session('invoice');
        $transaksi = Transaksi::where('user_id', Auth::user()->id)
            ->where('invoice', $invoice)
            ->first();
        $dataCustomer = DataCustomer::where('user_id', Auth::user()->id)
            ->where('invoice', $transaksi->invoice)
            ->first();

        return view('landing.payment.index', ['title' => 'Payment', 'invoice' => $invoice], compact('transaksi', 'dataCustomer'));
    }


    public function callback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {

                $transaksi = Transaksi::where('invoice', $request->order_id)->firstOrFail();

                if ($transaksi) {
                    $transaksi->update(['status_payment' => 'paid']);
                }
            }
        }
    }
}
