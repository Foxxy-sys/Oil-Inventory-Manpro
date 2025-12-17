<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'id',
        'nama_supplier',
        'kontak',
        'alamat',
        'email'
    ];

    // Relasi ke barang masuk (opsional)
    public function barangMasuk()
    {
        return $this->hasMany(\App\Models\BarangMasuk::class, 'supplier_id');
    }
}
