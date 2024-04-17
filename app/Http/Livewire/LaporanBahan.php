<?php

namespace App\Http\Livewire;

use App\Models\Stok;
use App\Models\Bahan;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanBahan extends Component
{
    protected $bahans;
    public $nama_bahan;
    public $jumlah;
    public $satuan;
    public $harga;
    public $total_harga;
    public $tanggal_awal;
    public $tanggal_akhir;
    public $tanggal_beli;
    
    public function render()
    {
        $this->bahans = Bahan::all();
        return view('livewire.laporan-bahan', [
            'bahans' => $this->bahans,
        ])->extends('layouts.app')->section('content');
    }

    public function cetak()
    {
        $this->validate([
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
        ], [
            'tanggal_awal.required' => 'Wajib diisi',
            'tanggal_akhir.required' => 'Wajib diisi',
        ]);

        $this->bahans = Stok::join('produks', 'produks.id', '=', 'stoks.bahan_id')
            ->select('produks.nama_produk', 'produks.harga', 'stoks.jumlah', 'stoks.total_harga', 'stoks.tanggal_beli')
            ->whereBetween('stoks.tanggal_beli', [$this->tanggal_awal, $this->tanggal_akhir])
            ->orderBy('stoks.id', 'desc')
            ->get();

        // jika tidak ada data yang dicetak maka tampilkan pesan
        if ($this->bahans->isEmpty()) {
            session()->flash('error', 'Tidak ada data ditemukan.');
            return redirect()->back();
        }

        // cetak
        $pdf = Pdf::loadView('livewire.pdf-laporan-bahan', ['bahans' => $this->bahans])->setPaper('a4', 'potrait')->output();
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, date('Y-m-d_H:i:s') . '_laporan_bahan' . '.pdf');
    }
}
