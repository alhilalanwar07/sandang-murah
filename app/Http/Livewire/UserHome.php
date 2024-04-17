<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use Livewire\Component;

class UserHome extends Component
{
    protected $produks, $latestProduks, $topProduks, $expansiveProduks, $slide5;
    public $search, $perPage = 8;
    protected $updatesQueryString = ['search' => ['except' => ''], 'perPage' => ['except' => 8]];

    public function render()
    {
        $this->produks = Produk::where('nama_produk', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'asc')
            ->paginate($this->perPage);
            // latest() untuk urutan terbaru
        $this->latestProduks = Produk::latest()->take(3)->get();
        $this->topProduks = Produk::orderBy('stok', 'asc')->take(3)->get();
        $this->expansiveProduks = Produk::orderBy('harga', 'desc')->take(3)->get();
        $this->slide5 = Produk::latest()->take(5)->get();
        return view('livewire.user-home',[
            'produks' => $this->produks,
            'latestProduks' => $this->latestProduks,
            'topProduks' => $this->topProduks,
            'expansiveProduks' => $this->expansiveProduks,
            'slide5' => $this->slide5,
        ])->extends('layouts.user')->section('content');
    }
}
