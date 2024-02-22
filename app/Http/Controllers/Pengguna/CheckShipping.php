<?php

namespace App\Http\Controllers\Pengguna;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CheckShipping extends Controller
{

    public function cekOngkir(Request $request)
    {
        $ongkir = $request->input('ongkir');

        session(['ongkir' => $ongkir]);

        Alert::success('Success', 'Successfully Add Shipping Cost');
        return redirect()->route('checkout');
    }
}
