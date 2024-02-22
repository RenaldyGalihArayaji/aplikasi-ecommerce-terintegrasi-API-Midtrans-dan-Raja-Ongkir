<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ShippingAddress as Address;
use RealRashid\SweetAlert\Facades\Alert;

class ShippingAddress extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippingAddress = Address::with(['province', 'city'])->latest()->get();
        return view('admin.shipping-address.index', ['title' => 'Shipping Address'], compact('shippingAddress'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all();
        return view('admin.shipping-address.create', ['title' => 'Create Shipping Address '], compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'province' => 'required',
            'city' => 'required',
            'address' => 'required'
        ]);

        Address::create([
            'province_id' => $request->province,
            'city_id' => $request->city,
            'address' => $request->address
        ]);

        Alert::success('success', 'Data Successfully Added');
        return redirect()->route('shipping-address.index');
    }


    public function edit(string $id)
    {
        $shippingAddress = Address::with(['province', 'city'])->find($id);
        $provinces = Province::all();
        return view('admin.shipping-address.edit', ['title' => 'Edit Shipping Address '], compact('shippingAddress', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'province' => 'required',
            'city' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);

        $shippingAddress = Address::findorFail($id);
        $shippingAddress->update([
            'province_id' => $request->province,
            'city_id' => $request->city,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        Alert::success('success', 'Data Successfully Updated');
        return redirect()->route('shipping-address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shippingAddress = Address::find($id);
        $shippingAddress->delete();
        return redirect()->route('shipping-address.index');
    }
}
