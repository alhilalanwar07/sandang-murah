<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produks';
    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'deskripsi',
        'gambar1',
        'gambar2',
        'gambar3',
        'status'
    ];

    // keranjang
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    // pesanan
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
