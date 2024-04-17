<?php

namespace App\Models;

use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';
    protected $fillable = [
        'user_id',
        'kode_pesanan',
        'total_harga1',
        'status_pesanan',
        'ongkir'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // notifikasi
    public function notifikasis()
    {
        return $this->hasMany(Notifikasi::class, 'pesanan_id', 'id');
    }
}
