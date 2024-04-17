<?php

namespace App\Http\Livewire;

use Livewire\Request;
use App\Models\Produk;
use Livewire\Component;

class UserProdukDetail extends Component
{
    protected $produks;
    public $produk_id, $nama_produk, $harga, $stok, $deskripsi, $gambar1, $gambar2, $gambar3, $status;

    public function render(Request $request, int $id)
    {
        $this->produks = Produk::where('id', $request->id)->first();
        dd($this->produks);
        $this->nama_produk = $this->produks->nama_produk;
        $this->harga = $this->produks->harga;
        $this->stok = $this->produks->stok;
        $this->deskripsi = $this->produks->deskripsi;
        $this->gambar1 = $this->produks->gambar1;
        $this->gambar2 = $this->produks->gambar2;
        $this->gambar3 = $this->produks->gambar3;
        $this->status = $this->produks->status;

        return view('livewire.user-produk-detail',[
            'produks' => $this->produks,
            'nama_produk' => $this->nama_produk,
            'harga' => $this->harga,
            'stok' => $this->stok,
            'deskripsi' => $this->deskripsi,
            'gambar1' => $this->gambar1,
            'gambar2' => $this->gambar2,
            'gambar3' => $this->gambar3,
            'status' => $this->status,
            dd($this->produks),
        ])->extends('layouts.user')->section('content');
    }
}
