<?php

namespace App\Http\Controllers\Pengguna;

use App\Models\Order;
use App\Models\Province;
use App\Models\DataCustomer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Admin\ShippingAddress;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function index()
    {
        $provinces = Province::all();
        $invoice = session('invoice');
        $orders = Order::with('product')
            ->where('user_id', Auth::user()->id)
            ->where('invoice', $invoice)
            ->get();

        return view('landing.checkout.index', ['title' => 'Checkout', 'cekongkir' => '', 'invoice' => $invoice], compact('provinces', 'orders'));
    }

    public function data_customer(Request $request)
    {
        $user = Auth::user();
        $invoice = session('invoice');
        $orders = Order::with('product')
            ->where('user_id', $user->id)
            ->where('invoice', $invoice)
            ->get();

        $weight = 0; // Initialize as numeric value

        foreach ($orders as $order) {
            $weight += $order->product->weight;
        }

        $provinces = Province::all();
        $origin = ShippingAddress::where('status', 'active')->first();

        $response = Http::asForm()->withHeaders([
            'key' => 'b3842f7a568a7b2ce694e33be4e8987f',
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $origin->city_id,
            'destination' => $request->city,
            'weight' => (float) $weight, // Cast weight to a numeric format
            'courier' => $request->courier,
        ]);

        DataCustomer::create([
            'invoice' => $invoice,
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'province_id' => $request->province,
            'city_id' => $request->city,
            'address' => $request->address,
            'email' => $user->email,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code,
            'courier' => $request->courier,
        ]);

        $cekongkir = $response['rajaongkir']['results'][0]['costs'];
        return view('landing.checkout.index', ['title' => 'Ongkir', 'invoice' => $invoice], compact('provinces', 'cekongkir', 'orders'));
    }
}
