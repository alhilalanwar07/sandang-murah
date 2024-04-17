<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use App\Models\Pesanan;
use Livewire\Component;
use App\Models\Notifikasi;
use Livewire\WithPagination;
use App\Models\DetailPesanan;

class DataPenjualan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 10;

    protected $updatesQueryString = ['search'];

    protected $penjualans, $detail_pesanans, $produks;
    public $nama_pelanggan,$kode_pesanan, $nama_produk, $jumlah, $total_harga1, $status_pesanan, $produk_id,  $total,$harga;

    public $detail_pesanans1 = [];

    public function render()
    {
        $this->penjualans = Pesanan::join('users', 'users.id', '=', 'pesanans.user_id')
            ->select('pesanans.*', 'users.name as nama_pelanggan')
            ->orderBy('pesanans.id', 'desc')
            ->paginate($this->perPage);
        $this->detail_pesanans = DetailPesanan::join('produks', 'detail_pesanans.produk_id', '=', 'produks.id')
            ->where('detail_pesanans.kode_pesanan', $this->kode_pesanan)
            ->select('detail_pesanans.*', 'produks.nama_produk', 'produks.harga')
            ->get();
        $this->produks = Produk::all();
        return view('livewire.data-penjualan', [
            'penjualans' => $this->penjualans,
            'detail_pesanans' => $this->detail_pesanans,
            'detail_pesanans1' => $this->detail_pesanans1,
            'produks' => $this->produks,
        ])->extends('layouts.app')->section('content');
    }

    public function detail($id)
    {
        $this->pesanan_id = $id;
        $this->detail_pesanans1 = DetailPesanan::join('produks', 'detail_pesanans.produk_id', '=', 'produks.id')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->where('pesanans.id', $this->pesanan_id)
            ->select('detail_pesanans.*', 'produks.nama_produk', 'produks.harga')
            ->get();
        $i = 1;
        foreach ($this->detail_pesanans1 as $detail) {
            $this->nama_produk[$i] = $detail->nama_produk;
            $this->jumlah[$i] = $detail->jumlah;
            $this->harga[$i] = $detail->harga;
            $this->total_harga1[$i] = $detail->total_harga;
            $i++;
        }

    }

    // menunggu -> diproses -> dikirim -> selesai
    public function konfirmasi($id)
    {
        $pesanan = Pesanan::find($id)->update([
            'status_pesanan' => 'diproses'
        ]);

        $user_id = Pesanan::find($id)->user_id;
        $pesanan_id = Pesanan::find($id)->id;

        Notifikasi::create([
            'user_id' => $user_id,
            'pesanan_id' => $pesanan_id,
            'pesan' => 'Pesanan anda sedang diproses',
            'status' => 'unread'
        ]);
        session()->flash('message', 'Pesanan berhasil dikonfirmasi');
    }

    public function diproses($id)
    {
        $pesanan = Pesanan::find($id)->update([
            'status_pesanan' => 'dikirim'
        ]);

        $user_id = Pesanan::find($id)->user_id;
        $pesanan_id = Pesanan::find($id)->id;

        Notifikasi::create([
            'user_id' => $user_id,
            'pesanan_id' => $pesanan_id,
            'pesan' => 'Pesanan anda sedang dikirim',
            'status' => 'unread'
        ]);
        session()->flash('message', 'Pesanan berhasil dikirim');
    }

    public function dikirim($id)
    {
        $pesanan = Pesanan::find($id)->update([
            'status_pesanan' => 'selesai'
        ]);

        $detail_pesanans = DetailPesanan::where('pesanan_id', $id)->get();
        foreach ($detail_pesanans as $detail) {
            $produk = Produk::find($detail->produk_id);
            $produk->update([
                'stok' => $produk->stok - $detail->jumlah
            ]);
        }

        $user_id = Pesanan::find($id)->user_id;
        $pesanan_id = Pesanan::find($id)->id;

        Notifikasi::create([
            'user_id' => $user_id,
            'pesanan_id' => $pesanan_id,
            'pesan' => 'Pesanan anda telah selesai',
            'status' => 'unread'
        ]);
        
        session()->flash('message', 'Pesanan berhasil selesai');
    }

    public function batalkan($id)
    {
        $pesanan = Pesanan::find($id)->update([
            'status_pesanan' => 'batal'
        ]);

        $user_id = Pesanan::find($id)->user_id;
        $pesanan_id = Pesanan::find($id)->id;

        Notifikasi::create([
            'user_id' => $user_id,
            'pesanan_id' => $pesanan_id,
            'pesan' => 'Pesanan anda dibatalkan',
            'status' => 'unread'
        ]);
        session()->flash('message', 'Pesanan berhasil selesai');
    }

}
