<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'category_id',
        'stok',
        'harga_beli',
        'harga_jual',
        'stok_minimum'
    ];

    /**
     * Relasi ke kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke barang masuk
     */
    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    /**
     * Relasi ke barang keluar
     */
    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }

    /**
     * 🔔 CEK STOK MENIPIS
     */
    public function isStokMenipis()
    {
        return $this->stok <= $this->stok_minimum;
    }
}