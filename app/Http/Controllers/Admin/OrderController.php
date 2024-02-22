<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Transaksi;
use App\Models\OrderDetail;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\ShippingAddress;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::latest()->get();
        return view('admin.order.index', ['title' => 'Order'], compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        $order = Order::with('product')->where('invoice', $transaksi->invoice)->get();
        $dataCustomer = DataCustomer::with(['province', 'city'])->where('invoice', $transaksi->invoice)->first();
        return view('admin.order.show', ['title' => 'Show Order'], compact('transaksi', 'order', 'dataCustomer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('admin.order.edit', ['title' => 'Edit Order'], compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Menggunakan findOrFail untuk mencari transaksi
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'number_track' => $request->number_track,
            'status_delivery' => $request->status_delivery,
        ]);

        Alert::success('Success', 'Data Successfully Updated');
        return redirect()->route('order.index');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->back();
    }
}
