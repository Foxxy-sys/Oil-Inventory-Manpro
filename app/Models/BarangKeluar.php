<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';

    protected $fillable = [
        'product_id',
        'user_id',
        'tanggal',
        'jumlah',
        'harga_jual',
        'total',
    ];

    // 🔹 Cast tanggal ke Carbon
    protected $casts = [
        'tanggal' => 'datetime',
    ];

    /**
     * Relasi ke produk
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke user (yang input transaksi)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke pemasukan
     * 1 barang keluar = 1 pemasukan
     */
    public function pemasukan()
    {
        return $this->hasOne(Pemasukan::class);
    }
}