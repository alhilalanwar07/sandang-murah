<?php

namespace App\Http\Livewire;

use App\Models\Bahan;
use App\Models\Produk as ProdukModel;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DataBahanmasuk extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 10;

    protected $updatesQueryString = ['search' => ['except' => ''], 'perPage' => ['except' => 10]];

    public $bahan_id;
    public $jumlah;
    public $total_harga;
    public $supplier;
    public $tanggal_beli;
    public $tanggal_expired;
    public $stok_id;
    public $barang_id;
    public $nama_bahan;
    protected $barangs;

    protected $stoks;
    protected $bahans;
    public function render()
    {
        $this->stoks = Stok::join('produks', 'stoks.bahan_id', '=', 'produks.id')
            ->select('stoks.*', 'produks.nama_produk')
            ->where('produks.nama_produk', 'like', '%'.$this->search.'%')
            ->orderBy('stoks.id', 'desc')
            ->paginate($this->perPage);
        $this->bahans = Bahan::all();
        $this->barangs = ProdukModel::all();
        return view('livewire.data-bahanmasuk', [
            'stoks' => $this->stoks,
            'bahans' => $this->bahans,
            'barangs' => $this->barangs
        ])->extends('layouts.app')->section('content');
    }

    public function resetInput()
    {
        $this->barang_id = null;
        $this->jumlah = null;
        $this->total_harga = null;
        $this->supplier = null;
        $this->tanggal_beli = null;
        $this->tanggal_expired = null;
    }

    public function stokId($id)
    {
        $this->stok_id = $id;
        $stok = Stok::find($id);
        $this->bahan_id = $stok->barang_id;
        $this->jumlah = $stok->jumlah;
        $this->total_harga = $stok->total_harga;
        $this->supplier = $stok->supplier;
        $this->tanggal_beli = $stok->tanggal_beli;
        $this->tanggal_expired = $stok->tanggal_expired;
    }

    public function store()
    {
        $this->validate([
            'barang_id' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'supplier' => 'required',
            'tanggal_beli' => 'required',
            'tanggal_expired' => 'required',
        ]);

        $stok = Stok::create([
            'bahan_id' => $this->barang_id,
            'jumlah' => $this->jumlah,
            'total_harga' => $this->total_harga,
            'supplier' => $this->supplier,
            'tanggal_beli' => $this->tanggal_beli,
            'tanggal_expired' => $this->tanggal_expired,
        ]);

        $stokProduk = ProdukModel::where('id', $this->barang_id)->first()->stok;

        // update stok bahan dijumlah dengan jumlah bahan masuk
        ProdukModel::where('id', $this->barang_id)->update([
            'stok' => $stokProduk + $this->jumlah
        ]);

        $this->resetInput();
        session()->flash('message', 'Data Berhasil Ditambahkan');
    }

    public function update()
    {
        $this->validate([
            'barang_id' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'supplier' => 'required',
            'tanggal_beli' => 'required',
            'tanggal_expired' => 'required',
        ]);

        if ($this->stok_id) {
            $stok = Stok::find($this->stok_id);
            $stok->update([
                'bahan_id' => $this->barang_id,
                'jumlah' => $this->jumlah,
                'total_harga' => $this->total_harga,
                'supplier' => $this->supplier,
                'tanggal_beli' => $this->tanggal_beli,
                'tanggal_expired' => $this->tanggal_expired,
            ]);
            $this->resetInput();
            session()->flash('message', 'Data Berhasil Diubah');
        }
    }

    public function delete($id)
    {
        if ($id) {
            $stok = Stok::find($id);
            $stok->delete();
            session()->flash('message', 'Data Berhasil Dihapus');
        }
    }
}
