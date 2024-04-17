<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use Livewire\Component;
use App\Models\Produksi;
use Livewire\WithPagination;

class DataProduksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $perPage = 10;

    protected $updatesQueryString = ['search' => ['except' => ''], 'perPage' => ['except' => 10]];

    public $produk_id, $jumlah_produksi, $total_produksi, $tanggal_produksi, $tanggal_expired, $produksi_id, $nama_produk;

    protected $produksis, $produks;

    public function render()
    {
        $this->produksis = Produksi::join('produks', 'produksis.produk_id', '=', 'produks.id')
            ->select('produksis.*', 'produks.nama_produk')
            ->where('produk_id', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'asc')
            ->paginate($this->perPage);
        $this->produks = Produk::all();
        $this->produk1 = Produk::find($this->produk_id);
        if ($this->jumlah_produksi != null) {
            $this->total_produksi = $this->jumlah_produksi * ($this->produk1->stok ?? 1);
        }
        return view('livewire.data-produksi',[
            'produksis' => $this->produksis,
            'produks' => $this->produks,
        ])->extends('layouts.app')->section('content');
    }

    public function resetInput()
    {
        $this->produk_id = null;
        $this->jumlah_produksi = null;
        $this->total_produksi = null;
        $this->tanggal_produksi = null;
        $this->tanggal_expired = null;
    }

    public function produksiId($id)
    {
        $this->produksi_id = $id;
        $produksi = Produksi::find($id);
        $this->produk_id = $produksi->produk_id;
        $this->jumlah_produksi = $produksi->jumlah_produksi;
        $this->total_produksi = $produksi->total_produksi;
        $this->tanggal_produksi = $produksi->tanggal_produksi;
        $this->tanggal_expired = $produksi->tanggal_expired;
    }

    public function store()
    {
        $this->validate([
            'produk_id' => 'required',
            'jumlah_produksi' => 'required',
            'total_produksi' => 'required',
            'tanggal_produksi' => 'required',
            'tanggal_expired' => 'required',
        ]);

        Produksi::create([
            'produk_id' => $this->produk_id,
            'jumlah_produksi' => $this->jumlah_produksi,
            'total_produksi' => $this->total_produksi,
            'tanggal_produksi' => $this->tanggal_produksi,
            'tanggal_expired' => $this->tanggal_expired,
        ]);

        session()->flash('message', 'Data Berhasil Ditambahkan');
        $this->resetInput();
    }

    public function update()
    {
        $this->validate([
            'produk_id' => 'required',
            'jumlah_produksi' => 'required',
            'total_produksi' => 'required',
            'tanggal_produksi' => 'required',
            'tanggal_expired' => 'required',
        ]);

        if ($this->produksi_id) {
            $produksi = Produksi::find($this->produksi_id);
            $produksi->update([
                'produk_id' => $this->produk_id,
                'jumlah_produksi' => $this->jumlah_produksi,
                'total_produksi' => $this->total_produksi,
                'tanggal_produksi' => $this->tanggal_produksi,
                'tanggal_expired' => $this->tanggal_expired,
            ]);
            session()->flash('message', 'Data Berhasil Diubah');
            $this->resetInput();
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $produksi = Produksi::find($id);
            $produksi->delete();
            session()->flash('message', 'Data Berhasil Dihapus');
        }
    }
}
