<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use App\Models\Pesanan;
use Livewire\Component;
use App\Models\Keranjang;
use App\Models\Pelanggan;
use App\Models\Notifikasi;
use Livewire\WithPagination;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\Auth;

class DataPenjualan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 10;

    protected $updatesQueryString = ['search'];

    protected $penjualans, $detail_pesanans, $produks;
    public $nama_pelanggan, $kode_pesanan, $nama_produk, $jumlah, $total_harga1, $status_pesanan, $produk_id, $total, $harga;

    protected $keranjang, $keranjangs;
    public $detail_pesanans1 = [];
    public $jumlah_uang = 0;


    public function mount()
    {
        $auhtID = Auth::user()->id;
        $this->kode_pesanan = 'pesanan-' . $auhtID . '-' . mt_rand(1, 999999);
    }

    public function render()
    {
        $this->penjualans = Pesanan::join('users', 'users.id', '=', 'pesanans.user_id')
            ->select('pesanans.*', 'users.name as nama_pelanggan')
            ->orderBy('pesanans.id', 'desc')
            ->paginate($this->perPage);
        $this->produks = Produk::all();

        return view('livewire.data-penjualan', [
            'penjualans' => $this->penjualans,
            'detail_pesanans' => $this->detail_pesanans,
            'detail_pesanans1' => $this->detail_pesanans1,
            'produks' => $this->produks,
            'keranjangs' => Keranjang::join('produks', 'keranjangs.produk_id', '=', 'produks.id')
                ->where('user_id', Auth::user()->id ?? 0)
                ->select('keranjangs.*', 'produks.nama_produk', 'produks.harga', 'produks.gambar1')
                ->get(),
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
            'status_pesanan' => 'diproses',
        ]);

        $user_id = Pesanan::find($id)->user_id;
        $pesanan_id = Pesanan::find($id)->id;

        Notifikasi::create([
            'user_id' => $user_id,
            'pesanan_id' => $pesanan_id,
            'pesan' => 'Pesanan anda sedang diproses',
            'status' => 'unread',
        ]);
        session()->flash('message', 'Pesanan berhasil dikonfirmasi');
    }

    public function diproses($id)
    {
        $pesanan = Pesanan::find($id)->update([
            'status_pesanan' => 'dikirim',
        ]);

        $user_id = Pesanan::find($id)->user_id;
        $pesanan_id = Pesanan::find($id)->id;

        Notifikasi::create([
            'user_id' => $user_id,
            'pesanan_id' => $pesanan_id,
            'pesan' => 'Pesanan anda sedang dikirim',
            'status' => 'unread',
        ]);
        session()->flash('message', 'Pesanan berhasil dikirim');
    }

    public function dikirim($id)
    {
        $pesanan = Pesanan::find($id)->update([
            'status_pesanan' => 'selesai',
        ]);

        $detail_pesanans = DetailPesanan::where('pesanan_id', $id)->get();
        foreach ($detail_pesanans as $detail) {
            $produk = Produk::find($detail->produk_id);
            $produk->update([
                'stok' => $produk->stok - $detail->jumlah,
            ]);
        }

        $user_id = Pesanan::find($id)->user_id;
        $pesanan_id = Pesanan::find($id)->id;

        Notifikasi::create([
            'user_id' => $user_id,
            'pesanan_id' => $pesanan_id,
            'pesan' => 'Pesanan anda telah selesai',
            'status' => 'unread',
        ]);

        session()->flash('message', 'Pesanan berhasil selesai');
    }

    public function batalkan($id)
    {
        $pesanan = Pesanan::find($id)->update([
            'status_pesanan' => 'batal',
        ]);

        $user_id = Pesanan::find($id)->user_id;
        $pesanan_id = Pesanan::find($id)->id;

        Notifikasi::create([
            'user_id' => $user_id,
            'pesanan_id' => $pesanan_id,
            'pesan' => 'Pesanan anda dibatalkan',
            'status' => 'unread',
        ]);
        session()->flash('message', 'Pesanan berhasil selesai');
    }

    public function addToCart($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        } else {
            $this->validate([
                'jumlah.' . $id => 'required',
            ],
                [
                    'jumlah.' . $id . '.required' => 'Jumlah harus diisi',
                ]);
            $cart = Keranjang::where('user_id', Auth::user()->id)->where('produk_id', $id)->first();
            $produk = Produk::find($id);
            // jika belum login maka akan diarahkan ke halaman login
            if (!$cart) {
                Keranjang::create([
                    'user_id' => Auth::user()->id,
                    'produk_id' => $id,
                    'jumlah' => $this->jumlah[$id],
                ]);
                // kosongkan inputan
                $this->reset('jumlah');
                // alert with session
                session()->flash('message', 'Produk berhasil ditambahkan ke keranjang');
                // return redirect('/u/produk')->with('message', 'Produk berhasil ditambahkan ke keranjang');
            } else {
                $cart->update([
                    'jumlah' => $cart->jumlah + $this->jumlah[$id],
                ]);
                // kosongkan inputan
                $this->reset('jumlah');

                // alert with session
                session()->flash('message', 'Produk berhasil ditambahkan ke keranjang');
            }
        }
    }

    public function addTransaksi()
    {

        $keranjangs = Keranjang::join('produks', 'keranjangs.produk_id', '=', 'produks.id')
            ->where('user_id', Auth::user()->id)
            ->select('keranjangs.*', 'produks.nama_produk', 'produks.harga')
            ->get();

        $this->total = $keranjangs->sum(function ($keranjang) {
            return $keranjang->jumlah * $keranjang->harga;
        });

        if ($keranjangs == null) {
            session()->flash('message', 'Keranjang masih kosong, silahkan belanja terlebih dahulu');
        } else {
            $kd_pesan = $this->kode_pesanan;
            $this->pesanans = Pesanan::create([
                'user_id' => Auth::user()->id,
                'kode_pesanan' => $kd_pesan,
                'total_harga1' => $this->total,
                'status_pesanan' => 'selesai',
            ]);

            foreach ($keranjangs as $keranjang) {
                $detail_pesanans = DetailPesanan::create([
                    'pesanan_id' => $this->pesanans->id,
                    'produk_id' => $keranjang->produk_id,
                    'jumlah' => $keranjang->jumlah,
                    'total_harga' => $keranjang->jumlah * $keranjang->harga,
                    'kode_pesanan' => $kd_pesan,
                ]);
            }

            $keranjangs->each->delete();
            return redirect('/penjualan')->with('message', 'Pesanan berhasil dibuat');
        }
    }

}
