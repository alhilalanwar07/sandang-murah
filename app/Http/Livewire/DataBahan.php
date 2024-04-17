<?php

namespace App\Http\Livewire;

use App\Models\Bahan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class DataBahan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    use WithFileUploads;

    public $search, $perPage = 10;
    public $nama_bahan, $satuan, $harga, $stok, $gambar, $bahan_id;

    protected $updatesQueryString = ['search', 'perPage'];

    protected $bahans;

    public function render()
    {
        $this->bahans = Bahan::where('nama_bahan', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);
        return view('livewire.data-bahan',[
            'bahans' => $this->bahans
        ])->extends('layouts.app')->section('content');
    }

    public function resetInput()
    {
        $this->nama_bahan = '';
        $this->satuan     = '';
        $this->harga      = '';
        $this->stok       = '';
        $this->gambar     = '';
        $this->bahan_id   = '';
    }

    public function bahanId($id)
    {
        $bahan          = Bahan::find($id);
        $this->bahan_id = $id;
        $this->nama_bahan = $bahan->nama_bahan;
        $this->satuan     = $bahan->satuan;
        $this->harga      = $bahan->harga;
        $this->stok       = $bahan->stok;
    }

    public function store()
    {
        $this->validate([
            'nama_bahan' => 'required',
            'harga'      => 'required',
            'stok'       => 'required',
            'gambar'     => 'required',
        ]);

        $imageName = time() . '.' . $this->gambar->extension();

        Bahan::create([
            'nama_bahan' => $this->nama_bahan,
            'satuan'     => 'null',
            'harga'      => $this->harga,
            'stok'       => $this->stok,
            'gambar'     => $this->gambar->storeAs('images', $imageName)
        ]);
        $this->resetInput();
        session()->flash('message', 'Kategori Created Successfully.');

    }

    public function update()
    {
        $this->validate([
            'nama_bahan' => 'required',
            'harga'      => 'required',
            'stok'       => 'required',
        ]);

        if ($this->bahan_id) {
            if ($this->gambar) {
                $imageName = time() . '.' . $this->gambar->extension();
                $bahan = Bahan::find($this->bahan_id);
                $bahan->update([
                    'nama_bahan' => $this->nama_bahan,
                    'satuan'     => 'null',
                    'harga'      => $this->harga,
                    'stok'       => $this->stok,
                    'gambar'     => $this->gambar->storeAs('images', $imageName)
                ]);

            } else {
                $bahan = Bahan::find($this->bahan_id);
                $bahan->update([
                    'nama_bahan' => $this->nama_bahan,
                    'satuan'     => 'null',
                    'harga'      => $this->harga,
                    'stok'       => $this->stok,
                ]);
            }

            $this->resetInput();
            session()->flash('message', 'Kategori Updated Successfully.');
        }
    }

    public function delete($id)
    {
        if ($id) {
            Bahan::where('id', $id)->delete();
            session()->flash('message', 'Kategori Deleted Successfully.');
        }
    }
}
