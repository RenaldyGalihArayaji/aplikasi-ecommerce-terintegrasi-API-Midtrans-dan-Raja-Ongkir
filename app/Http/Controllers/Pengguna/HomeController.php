<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::where('discount', '=', 0)->latest()->paginate(6);
        $product_discount = Product::where('discount', '>', 0)->latest()->paginate(6);
        $slide = Slider::all();

        return view('landing.home.index', ['title' => 'Home', 'product' => $product, 'slide' => $slide, 'product_discount' => $product_discount]);
    }
}
