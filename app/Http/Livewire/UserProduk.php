<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use Livewire\Component;
use App\Models\Keranjang;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class UserProduk extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 12;

    protected $updatesQueryString = ['search'];

    protected $produks, $latestProduks, $topProduks;

    public $jumlah, $user_id, $produk_id;
    public $nama_produk, $harga, $stok, $deskripsi, $gambar1, $gambar2, $gambar3, $status, $gambar, $kategori;

    public $detail = false;
    public function render()
    {
        $this->produks = Produk::where('nama_produk', 'like', '%'.$this->search.'%')
            ->paginate($this->perPage);
        $this->latestProduks = Produk::latest()->take(3)->get();
        $this->topProduks = Produk::orderBy('stok', 'asc')->take(3)->get();

        return view('livewire.user-produk',[
            'produks' => $this->produks,
            'latestProduks' => $this->latestProduks,
            'topProduks' => $this->topProduks,
        ])->extends('layouts.user')->section('content');
    }

    public function addToCart($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }else{
            $cart = Keranjang::where('user_id', Auth::user()->id)->where('produk_id', $id)->first();
            $produk = Produk::find($id);
            // jika belum login maka akan diarahkan ke halaman login
            if(!$cart) {
                Keranjang::create([
                    'user_id' => Auth::user()->id,
                    'produk_id' => $id,
                    'jumlah' => 1,
                ]);
                // alert with session
                session()->flash('message', 'Produk berhasil ditambahkan ke keranjang');
                // return redirect('/u/produk')->with('message', 'Produk berhasil ditambahkan ke keranjang');
            }else{
                $cart->update([
                    'jumlah' => $cart->jumlah + 1,
                ]);
                // alert with session
                session()->flash('message', 'Produk berhasil ditambahkan ke keranjang');
            }
        }
    }

    public function goToCart($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }else{
            $cart = Keranjang::where('user_id', Auth::user()->id)->where('produk_id', $id)->first();
            $produk = Produk::find($id);
            // jika belum login maka akan diarahkan ke halaman login
            if(!$cart) {
                Keranjang::create([
                    'user_id' => Auth::user()->id,
                    'produk_id' => $id,
                    'jumlah' => 1,
                ]);
                // alert with session
                return redirect('/u/keranjang');
            }else{
                $cart->update([
                    'jumlah' => $cart->jumlah + 1,
                ]);
                // alert with session
                return redirect('/u/keranjang');
            }
        }
    }

    public function produkId(Request $request, int $id)
    {
        $this->produk_id = $id;
        $produk = Produk::find($id);
        $this->nama_produk = $produk->nama_produk;
        $this->harga = $produk->harga;
        $this->stok = $produk->stok;
        $this->deskripsi = $produk->deskripsi;
        $this->gambar1 = $produk->gambar1;
        $this->gambar2 = $produk->gambar2;
        $this->gambar3 = $produk->gambar3;
        $this->status = $produk->status;
        $this->detail = true;
    }

    protected $listeners = [
        'openModal' => 'produkId',
    ];
}
