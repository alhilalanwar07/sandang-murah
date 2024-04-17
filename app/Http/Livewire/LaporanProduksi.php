<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Produksi;

class LaporanProduksi extends Component
{
    protected $produksis, $produksis1;
    public $produk_id, $jumlah_produksi, $total_produksi, $tanggal_produksi, $tanggal_expired, $tanggal_awal, $tanggal_akhir, $nama_produk;
    public function render()
    {
        $this->produksis = Produksi::all();
        return view('livewire.laporan-produksi',[
            'produksis' => $this->produksis
        ])->extends('layouts.app')->section('content');
    }

    public function cetak()
    {
        $this->produksis = Produksi::join('produks', 'produks.id', '=', 'produksis.produk_id')
            ->select('produksis.*', 'produks.nama_produk')
            ->whereBetween('produksis.created_at', [$this->tanggal_awal, $this->tanggal_akhir])
            ->get();

        // jika tidak ada data yang dicetak maka tampilkan pesan
        if ($this->produksis->isEmpty()) {
            session()->flash('error', 'Tidak ada data ditemukan.');
            return redirect()->back();
        }

        $pdf = \PDF::loadView('livewire.pdf-laporan-produksi', ['produksis' => $this->produksis])->output();
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
       }, date('Y-m-d_H:i:s') . '_laporan_bahan' . '.pdf');
    }
}
