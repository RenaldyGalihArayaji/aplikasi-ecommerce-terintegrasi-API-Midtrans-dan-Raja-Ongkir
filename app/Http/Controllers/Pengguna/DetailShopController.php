<?php

namespace App\Http\Controllers\Pengguna;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DetailShopController extends Controller
{
    public function index($id)
    {
        $data = Product::with('category')->findOrFail($id);
        return view('landing.detail_shop.index', ['title' => 'Detail Shop'], compact('data'));
    }


    // public function store(Request $request)
    // {
    //     // $request->validate([
    //     //     'quantity' => 'required'
    //     // ]);

    //     // $productId = $request->product_id;
    //     // $product = Product::find($productId);

    //     // if ($request->quantity > $product->stock) {
    //     //     Alert::error('Error', 'Quantity Exceeds Product Stock');
    //     //     return redirect()->back();
    //     // }

    //     $user =

    //     // Mencari pesanan untuk pengguna yang sedang login
    //     // $order = Order::where('user_id', Auth::user()->id)
    //     //     ->whereNull('processed_at') // Pastikan pesanan belum diproses
    //     //     ->first();

    //     // if (!$order) {
    //     //     // Jika pesanan belum ada atau sudah diproses, buat pesanan baru
    //     //     $order = Order::create([
    //     //         'user_id'    => Auth::user()->id,
    //     //         'order_date' => now(),
    //     //     ]);
    //     // } else {
    //     //     // Jika pesanan sudah ada dan belum diproses, update order_date
    //     //     $order->update(['order_date' => now()]);
    //     // }

    //     // Menghitung total harga
    //     // $totalPrice = $product->price_final * $request->quantity;

    //     // OrderDetail::create([
    //     //     'user_id'    => Auth::user()->id,
    //     //     'order_id'   => $order->id,
    //     //     'product_id' => $product->id,
    //     //     'quantity'   => $request->quantity,
    //     //     'subtotal'   => $totalPrice,
    //     //     'note'       => $request->note,
    //     // ]);

    //     Alert::success('Success', 'Product Successfully Added To Cart');

    //     return redirect()->back();
    // }
}
