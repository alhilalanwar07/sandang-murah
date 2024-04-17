<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanProduk extends Model
{
    use HasFactory;
    protected $table = 'bahan_produks';
    protected $fillable = [
        'produk_id',
        'bahan_id',
        'jumlah'
    ];
}
