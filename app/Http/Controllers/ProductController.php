<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with('category')
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'   => 'required',
            'nama_barang'   => 'required',
            'category_id'   => 'required|exists:categories,id',
            'stok_minimum'  => 'required|integer|min:0',
            'harga_beli'    => 'required|numeric|min:0',
            'harga_jual'    => 'required|numeric|min:0',
        ]);

        Product::create([
            'kode_barang'  => $request->kode_barang,
            'nama_barang'  => $request->nama_barang,
            'category_id'  => $request->category_id,
            'stok'         => 0,
            'stok_minimum' => $request->stok_minimum,
            'harga_beli'   => $request->harga_beli,
            'harga_jual'   => $request->harga_jual,
        ]);

        return redirect('/products')->with('success', 'Produk berhasil ditambahkan');
    }
}