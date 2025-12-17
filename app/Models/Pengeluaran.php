<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = [
        'barang_masuk_id',
        'tanggal',
        'jumlah',
        'keterangan'
    ];

    /**
     * Relasi ke barang masuk
     * 1 pengeluaran = 1 barang masuk
     */
    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class);
    }
}
