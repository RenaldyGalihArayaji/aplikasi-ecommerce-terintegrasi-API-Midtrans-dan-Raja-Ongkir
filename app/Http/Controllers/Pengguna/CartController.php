<?php

namespace App\Http\Controllers\Pengguna;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaksi;
use App\Models\OrderDetail;
use App\Models\DataCustomer;
use App\Models\TransaksiNew;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::user()->id)->latest()->get();
        $order = Order::where('user_id', Auth::user()->id)->first();
        return view('landing.cart.index', ['title' => 'Cart'], compact('cart', 'order'));
    }

    public function add_cart(Request $request)
    {
        $request->validate([
            'quantity' => 'required'
        ]);

        $productId = $request->product_id;
        $product = Product::find($productId);

        if ($request->quantity > $product->stock) {
            Alert::error('Error', 'Quantity Exceeds Product Stock');
            return redirect()->back();
        }

        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
                'sub_total' => ($cart->quantity + $request->quantity) * $product->price_final,
                'note' => $request->note,
            ]);
            Alert::success('Success', 'Update To Cart');
        } else {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'sub_total' => $product->price_final * $request->quantity,
                'note' => $request->note,
            ]);
            Alert::success('Success', 'Add To Cart');
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $order = Cart::find($id);
        $order->delete();
        return redirect()->route('cart.index');
    }

    public function update($id, Request $request)
    {
        $cart = Cart::find($id);
        $product = Product::find($cart->product_id);

        $cart->update([
            'quantity' => $request->quantity,
            'sub_total' => $request->quantity * $product->price_final,
        ]);

        Alert::success('Success', 'Quantity Successfully Updated');
        return redirect()->back();
    }

    public function cartToCheckout()
    {
        $user = Auth::user();
        $data = Cart::where('user_id', $user->id)->get();
        $string = str_shuffle('0123456789012345678901234567890123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $invoice = 'INV/' . substr($string, 0, 10);

        foreach ($data as $cartItem) {
            $product = Product::findOrFail($cartItem->product_id);

            // Update stok produk
            $product->stock -= $cartItem->quantity;

            // Update status produk jika stok 0
            if ($product->stock <= 0) {
                $product->update(['status' => 'soldout']);
            }

            // Simpan perubahan stok
            $product->update(['stock' => $product->stock]);

            // Buat pesanan
            Order::create([
                'user_id' => $cartItem->user_id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'sub_total' => $cartItem->sub_total,
                'note' => $cartItem->note,
                'invoice' => $invoice
            ]);

            // Hapus item dari keranjang
            $cartItem->delete();

            request()->session()->put('invoice', $invoice);
        }

        return redirect()->route('checkout');
    }
}
