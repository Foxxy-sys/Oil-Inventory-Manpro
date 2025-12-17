<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BarangKeluar;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function create()
    {
        $products = Product::all();
        $barang_keluar = BarangKeluar::with(['product', 'user'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('barang_keluar.create', compact('products', 'barang_keluar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah'     => 'required|integer|min:1',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {

            $product = Product::findOrFail($request->product_id);

            // Cek stok
            if ($product->stok < $request->jumlah) {
                abort(400, 'Stok tidak mencukupi');
            }

            $total = $request->jumlah * $request->harga_jual;

            // Simpan Barang Keluar
            $barangKeluar = BarangKeluar::create([
                'product_id' => $product->id,
                'user_id'    => auth()->id() ?? 1,
                'tanggal'    => now(),
                'jumlah'     => $request->jumlah,
                'harga_jual' => $request->harga_jual,
                'total'      => $total
            ]);

            // Kurangi stok
            $product->decrement('stok', $request->jumlah);

            // Catat pemasukan
            Pemasukan::create([
                'barang_keluar_id' => $barangKeluar->id,
                'tanggal'          => now(),
                'jumlah'           => $total,
                'keterangan'       => 'Penjualan ' . $product->nama_barang
            ]);
        });

        return redirect()->back()->with('success', 'Barang keluar berhasil dicatat');
    }
}