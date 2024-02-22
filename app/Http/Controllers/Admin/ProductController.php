<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('category')->latest()->get();
        return view('admin.product.index', ['title' => 'Product'], compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.product.create', ['title' => 'Create-Product'], compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'weight' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $name = $request->file('image');
            $fileName = 'Product' . time() . '.' . $name->getClientOriginalExtension();
            Storage::putFileAs('/public/images_product', $request->file('image'), $fileName);
        }

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'price_final' => $request->price,
            'description' => htmlspecialchars_decode($request->description),
            'image' => $fileName,
        ]);

        Alert::success('Success', 'Product Successfully Added');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('admin.product.show', ['title' => 'Show-Product'], compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        $category = Category::where('id', '!=', $product->category_id)->get(['id', 'name']);
        return view('admin.product.edit', ['title' => 'Edit-Product'], compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'weight' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Hitung price_final berdasarkan price dan discount
        $price = $request->price;
        $discount = $request->discount;
        $price_final = $price - ($price * ($discount / 100));

        // Cek apakah upload file
        if ($request->hasFile('image')) {
            // Menghapus file lama dari storage
            Storage::delete('public/images_product/' . $product->image);

            // Upload file baru dengan format nama ditentukan
            $name = $request->file('image');
            $fileName = 'product_' . time() . '.' . $name->getClientOriginalExtension();
            $request->file('image')->storeAs('public/images_product', $fileName);
        } else {
            // Jika tidak ada file diunggah, gunakan nama file yang ada
            $fileName = $product->image;
        }

        // Update data di database
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id, // perbaikan typo pada nama field
            'price' => $price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'discount' => $discount,
            'price_final' => $price_final,
            'status' => $request->status,
            'description' => htmlspecialchars_decode($request->description),
            'image' => $fileName,
        ]);

        Alert::success('Success', 'Product Successfully Updated');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
