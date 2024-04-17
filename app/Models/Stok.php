<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $table = 'stoks';
    protected $fillable = [
        'bahan_id',
        'jumlah',
        'total_harga',
        'supplier',
        'tanggal_beli',
        'tanggal_expired',
    ];
}
