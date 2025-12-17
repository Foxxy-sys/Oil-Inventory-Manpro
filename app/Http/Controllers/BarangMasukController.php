<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Product;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function create()
    {
        $products = Product::all();
        $barang_masuk = BarangMasuk::with(['products', 'user'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('barang_masuk.create', compact('products', 'barang_masuk'));
    }

    public function index()
    {
        // Ambil semua barang masuk beserta relasi product dan user
        $barang_masuk = BarangMasuk::with(['products','supplier', 'user'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('barang_masuk.index', compact('barang_masuk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah'     => 'required|integer|min:1',
            'harga_beli' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {

            $product = Product::findOrFail($request->product_id);
            $total   = $request->jumlah * $request->harga_beli;

            // SIMPAN BARANG MASUK
            $barangMasuk = BarangMasuk::create([
                'product_id' => $product->id,
                'supplier_id' => 1,
                'user_id' => auth()->id() ?? 1,
                'tanggal' => now(),
                'jumlah' => $request->jumlah,
                'harga_beli' => $request->harga_beli,
                'total' => $total
            ]);

            // TAMBAH STOK
            $product->increment('stok', $request->jumlah);

            // CATAT PENGELUARAN
            Pengeluaran::create([
                'barang_masuk_id' => $barangMasuk->id,
                'tanggal' => now(),
                'jumlah' => $total,
                'keterangan' => 'Pembelian ' . $product->nama
            ]);
        });

        return redirect()->back()->with('success', 'Barang masuk berhasil');
    }
}