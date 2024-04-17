<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasis';
    protected $fillable = [
        'user_id',
        'pesanan_id',
        'pesan',
        'status_notifikasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
