<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 🔔 Produk stok menipis
        $produkMenipis = Product::whereColumn('stok', '<=', 'stok_minimum')->get();

        // 📊 Ringkasan
        $totalProduk = Product::count();
        $totalStok   = Product::sum('stok');

        // 💰 Laporan bulan ini
        $bulan = now()->month;
        $tahun = now()->year;

        $totalPemasukan = Pemasukan::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');

        $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');

        $laba = $totalPemasukan - $totalPengeluaran;

        return view('dashboard', compact(
            'produkMenipis',
            'totalProduk',
            'totalStok',
            'totalPemasukan',
            'totalPengeluaran',
            'laba'
        ));
    }
}
