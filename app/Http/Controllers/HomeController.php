<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Produksi;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bahans = Bahan::all();
        $produks = Produk::all();
        $produksis = Produksi::all();
        $penjualans = Pesanan::all();
        $pelanggans = Pelanggan::all();
        return view('home', compact('bahans', 'produks', 'produksis', 'penjualans', 'pelanggans'));
    }
}
