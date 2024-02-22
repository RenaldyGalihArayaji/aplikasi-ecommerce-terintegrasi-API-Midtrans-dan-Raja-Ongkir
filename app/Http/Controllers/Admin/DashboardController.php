<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $product = Product::count();
        $user = User::where('role', 'user')->count();
        $transaksi = Transaksi::get();
        return view('admin.dashboard.index', ['title' => 'Dashboard'], compact(['product', 'user', 'transaksi']));
    }
}
