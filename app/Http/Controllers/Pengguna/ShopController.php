<?php

namespace App\Http\Controllers\Pengguna;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index()
    {
        $product = Product::latest()->paginate(12);
        $category = Category::with('products')->latest()->paginate(10);
        return view('landing.shop.index', ['title' => 'Shop'], compact(['product', 'category']));
    }

    public function category($id)
    {
        $category = Category::with('products')->get();
        $product = Product::where('category_id', $id)->paginate(15);
        return view('landing.shop.index', ['title' => 'Shop'], compact(['product', 'category']));
    }

    public function filter(Request $request)
    {
        // Mendapatkan nilai filter dari permintaan
        $sortOption = $request->input('sort');

        // Ambil semua kategori
        $categories = Category::all();

        // Mengambil produk berdasarkan kategori
        $productsQuery = Product::query();


        // Logika untuk menangani filter
        switch ($sortOption) {

            case 'price_asc':
                // Logika untuk harga menaik
                $productsQuery->orderBy('price', 'asc');
                break;

            case 'price_desc':
                // Logika untuk harga menurun
                $productsQuery->orderBy('price', 'desc');
                break;

            default:
                // Logika default atau opsi "Newest Items"
                $productsQuery->latest();
                break;
        }

        // Ambil hasil query produk
        $filteredProducts = $productsQuery->paginate(12);

        // Kembalikan tampilan dengan produk yang difilter
        return view('landing.shop.index', [
            'title' => 'Shop',
            'product' => $filteredProducts,
            'category' => $categories,
        ]);
    }
}
