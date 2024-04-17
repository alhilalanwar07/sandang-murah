<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pesanan;

class LaporanPenjualan extends Component
{
    protected $penjualans;
    public $cetak, $tanggal_awal, $tanggal_akhir;
    public function render()
    {
        $this->penjualans = Pesanan::get();
        return view('livewire.laporan-penjualan',[
            'penjualans' => $this->penjualans,
        ])->extends('layouts.app')->section('content');
    }

    public function cetak()
    {
        $this->validate([
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
        ]);

        $this->penjualans = Pesanan::whereBetween('pesanans.created_at', [$this->tanggal_awal, $this->tanggal_akhir])
            ->get();

        // jika tidak ada data yang dicetak maka tampilkan pesan
        if ($this->penjualans->isEmpty()) {
            session()->flash('error', 'Tidak ada data ditemukan.');
            return redirect()->back();
        }
        // cetak
        $pdf = \PDF::loadView('livewire.pdf-laporan-penjualan',['penjualans' => $this->penjualans])->output();
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, date('Y-m-d_H:i:s') . '_laporan_penjualan' . '.pdf');
    }
}
