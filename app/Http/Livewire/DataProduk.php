<?php

namespace App\Http\Livewire;

use App\Models\Bahan;
use App\Models\Produk;
use Livewire\Component;
use App\Models\BahanProduk;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DataProduk extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    use WithFileUploads;

    public $produk;
    public $nama_produk;
    public $harga;
    public $stok;
    public $deskripsi;
    public $gambar1;
    public $gambar2;
    public $gambar3;
    public $gambar4;
    public $gambar5;
    public $gambar6;
    public $status;
    public $produk_id;

    protected $produks;
    protected $bahans;
    protected $bahan_produks;
    protected $bahan1;
    protected $jumlah_bahan;

    public $bahan_id1;
    public $bahan_id2;
    public $bahan_id3;
    public $bahan_id4;
    public $bahan_id5;
    public $bahan_id6;
    public $jumlah1;
    public $jumlah2;
    public $jumlah3;
    public $jumlah4;
    public $jumlah5;
    public $jumlah6;

    public $bahan = [];
    public $jumlah;
    public $bahan_id;
    public $nama_bahan;
    public $gambar;
    public $kategori;
    public $i = 1;

    protected $updateQueryString = ['search' => ['except' => ''], 'sortField' => ['except' => ''], 'sortAsc' => ['except' => '1'], 'perPage' => ['except' => '10']];
    public $search;
    public $sortField;
    public $sortAsc = true;
    public $perPage = '10';

    public function addBahan()
    {
        // $i       = $i+1;
        $this->i++;
        array_push($this->bahan, $this->i);
    }
    public function render()
    {
        $this->produks = Produk::where('nama_produk', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        // dd($this->produks);
        $this->bahans = Bahan::all();
        $this->bahan_produks = BahanProduk::join('bahans', 'bahans.id', '=', 'bahan_produks.bahan_id')
            ->join('produks', 'produks.id', '=', 'bahan_produks.produk_id')
            ->select('bahans.nama_bahan', 'bahan_produks.jumlah')
            ->where('produk_id', $this->produk_id)->get();
        return view('livewire.data-produk', [
            'produks' => $this->produks,
            'bahans' => $this->bahans,
            'bahan_produks' => $this->bahan_produks,
            'jumlah_bahan' => $this->jumlah_bahan,
        ])->extends('layouts.app')->section('content');
    }

    public function resetInput()
    {
        $this->nama_produk = '';
        $this->harga       = '';
        $this->stok        = '';
        $this->deskripsi   = '';
        $this->gambar1     = '';
        $this->gambar2     = '';
        $this->gambar3     = '';
        $this->gambar4     = '';
        $this->gambar5     = '';
        $this->gambar6     = '';
        $this->status      = '';
        $this->produk_id   = '';
        $this->jumlah1     = '';
        $this->jumlah2     = '';
        $this->jumlah3     = '';
        $this->jumlah4     = '';
        $this->jumlah5     = '';
        $this->jumlah6     = '';
        $this->kategori      = '';
        $this->gambar      = '';


    }

    public function produkId($id)
    {
        $this->produk_id   = $id;
        $produk            = Produk::find($this->produk_id);
        $this->nama_produk = $produk->nama_produk;
        $this->harga       = $produk->harga;
        $this->stok        = $produk->stok;
        $this->deskripsi   = $produk->deskripsi;
        $this->status      = $produk->status;
        $this->gambar1     = $produk->gambar1;
        $this->jumlah_bahan = BahanProduk::count();
        $i = 1;
        $this->bahan_produks = BahanProduk::join('bahans', 'bahans.id', '=', 'bahan_produks.bahan_id')
            ->join('produks', 'produks.id', '=', 'bahan_produks.produk_id')
            ->select('bahans.nama_bahan', 'bahan_produks.jumlah')
            ->where('produk_id', $this->produk_id)->get();


        // dd($this->bahan);
    }

    public function store()
    {
        $numtextrand = rand(1, 10000000000000);
        $this->validate([
            'nama_produk' => 'required',
            'harga'       => 'required',
            'deskripsi'   => 'required',
            'gambar'     => 'required',
            'stok'        => 'required',
        ]);

        if($this->gambar) {
            $imgproduk1 = time().'.'.$numtextrand.$this->gambar->extension();
        }

        $produk = Produk::create([
            'nama_produk' => $this->nama_produk,
            'harga'       => $this->harga,
            'stok'        => $this->stok,
            'deskripsi'   => $this->deskripsi,
            'gambar1'     => $this->gambar->storeAs('images', $imgproduk1),
            'gambar2'     => $this->kategori,
            'status'      => 'aktif',
        ]);

        // get id produk last
        $produkid = $produk->id;

        $this->bahan = [];
        $this->resetInput();
        session()->flash('message', 'Produk berhasil ditambahkan');
    }

    public function update()
    {
        $randomtype = rand(1, 10000000000000);
        $this->validate([
            'nama_produk' => 'required',
            'harga'       => 'required',
            'stok'        => 'required',
            'deskripsi'   => 'required',
        ]);

        if($this->gambar4) {
            $imgproduk1 = time().'.'.$randomtype.$this->gambar4->extension();
            $img1       = $this->gambar4->storeAs('images', $imgproduk1);
        } else {
            $img1 = $this->produk->gambar1 ?? null;
        }

        if($this->gambar5) {
            $imgproduk2 = time().'.'.$randomtype.$this->gambar5->extension();
            $img3       = $this->gambar5->storeAs('images', $imgproduk2);
        } else {
            $img3 = $this->produk->gambar2 ?? null;
        }

        if($this->gambar6) {
            $imgproduk3 = time().'.'.$randomtype.$this->gambar6->extension();
            $img4       = $this->gambar6->storeAs('images', $imgproduk3);
        } else {
            $img4 = $this->produk->gambar3 ?? null;
        }

        $this->produk = Produk::find($this->produk_id);

        $this->produk->update([
            'nama_produk' => $this->nama_produk,
            'harga'       => $this->harga,
            'stok'        => $this->stok,
            'deskripsi'   => $this->deskripsi,
            'gambar1'     => $img1,
            'gambar2'     => $this->kategori,
            'status'      => 'aktif',
        ]);

        $this->resetInput();
        session()->flash('message', 'Produk berhasil diupdate');
    }

    public function delete($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        session()->flash('message', 'Produk berhasil dihapus');
    }
}
