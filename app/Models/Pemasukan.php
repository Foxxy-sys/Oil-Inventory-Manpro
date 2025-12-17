<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';

    protected $fillable = [
        'barang_keluar_id',
        'tanggal',
        'jumlah',
        'keterangan',
    ];

    /**
     * Relasi ke barang keluar
     */
    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class);
    }
}