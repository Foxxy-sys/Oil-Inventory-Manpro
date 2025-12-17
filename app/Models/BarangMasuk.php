<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $fillable = [
        'product_id',
        'supplier_id',
        'user_id',
        'tanggal',
        'jumlah',
        'harga_beli',
        'total'
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    /**
     * RELASI KE PRODUK
     * 
     * Menggunakan nama "products" supaya cocok dengan Blade.
     */
    public function products()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    /**
     * RELASI KE USER
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    /**
     * RELASI KE SUPPLIER
     */
    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id');
    }
}