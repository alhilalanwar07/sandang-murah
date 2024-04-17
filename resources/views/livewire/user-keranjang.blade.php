<div>
    <!-- Breadcrumb Section Begin -->
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Keranjang</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-dark justify-content-center">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {{-- alert --}}
                    @if (session()->has('message'))
                    <div class="row" wire:poll.5000ms>
                        <div class="col-lg-12">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- end alert --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col" class="text-center">Jumlah</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($keranjangs as $keranjang)
                                <tr>
                                    <td data-label="Produk">
                                        {{-- <img src="{{url('/')}}/{{ $keranjang->gambar1 }}" alt="" width="100"> --}}
                                        <div class="ms-2">{{ $keranjang->nama_produk }}</div>
                                    </td>
                                    <td data-label="Harga">Rp. {{ number_format($keranjang->harga) }}</td>
                                    <td data-label="Jumlah" width="100px">
                                        <div class="input-group">
                                            {{-- <span class="input-group-text cursor-pointer dec qtybtn" wire:click="decrement({{ $keranjang->id }})">-</span> --}}
                                            <input type="text" class="form-control text-center" value="{{ $keranjang->jumlah }}" disabled>
                                            {{-- <span class="input-group-text cursor-pointer inc qtybtn" wire:click="increment({{ $keranjang->id }})">+</span> --}}
                                        </div>
                                    </td>
                                    <td data-label="Total" class="fw-bold text-center">
                                        Rp. {{ number_format($keranjang->harga * $keranjang->jumlah) }}</td>
                                    <td data-label="&nbsp;" class="text-end" width="100px">
                                        <button type="button" class="btn btn-sm btn-danger" wire:click="destroy({{ $keranjang->id }})">
                                            <span class="bi bi-trash"></span>
                                        </button>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <h5 class="text-danger">Keranjang masih kosong. Silahkan lanjutkan belanja.</h5>
                                    </td>
                                </tr>
                                @endforelse
                                {{-- total harga --}}
                                <tr class="bg-primary">
                                    {{-- <td colspan="3">&nbsp;</td> --}}
                                    <td colspan="3" class="fw-bold text-center text-white">Total Harga</td>
                                    <td class="fw-bold text-center text-white">Rp. {{ number_format($total) }}</td>
                                    <td class=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <a href="/u/produk" class="btn btn-outline-warning cart-btn">LANJUTKAN BELANJA</a>
                    {{-- <a href="#" class="btn btn-primary cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Upadate Cart</a> --}}
                </div>
                <div class="col-lg-6 fw-bold">
                    <table class="table table-sm">
                        <tr>
                            <td>Ongkos Kirim</td>
                            <td class="text-success">
                                @if($total >= 300000)
                                Rp. 0
                                <input type="hidden" wire:model="ongkir" value="0">
                                @elseif($total == 0)
                                Rp. 0
                                <input type="hidden" wire:model="ongkir" value="0">
                                @else
                                Rp. 20.000
                                <input type="hidden" wire:model="ongkir" value="20000">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Total Bayar</td>
                            <td class="text-danger">
                                @php
                                $total = 0;
                                @endphp
                                @foreach($keranjangs as $keranjang)
                                @php
                                $total += $keranjang->harga * $keranjang->jumlah;
                                @endphp
                                @endforeach

                                @if($total >= 300000)
                                Rp. {{ number_format($total) }}
                                <input type="hidden" wire:model="total" value="{{ $total }}">
                                @elseif($total == 0)
                                Rp. {{ number_format($total) }}
                                <input type="hidden" wire:model="total" value="{{ $total }}">
                                @else
                                Rp. {{ number_format($total+20000) }}
                                <input type="hidden" wire:model="total" value="{{ $total+20000 }}">
                                @endif
                            </td>
                        </tr>
                    </table>
                    <button type="button" class="btn btn-success btn-block" wire:click.prevent="checkout">CHECKOUT</button>
                </div>
            </div>
        </div>
</div>
</section>
<!-- Shoping Cart Section End -->

<style>
    /* decrement & increment */
    .pro-qty11 .dec.qtybtn {
        background: #f1f1f1;
        color: #000;
        font-size: 16px;
        font-weight: 700;
        line-height: 1;
        padding: 0 10px;
        position: relative;
        z-index: 1;
        /* pointer */
        cursor: pointer;
    }

    /* BTN HOVER */
    .pro-qty11 .dec.qtybtn:hover {
        background: #ff6e40;
        color: #fff;
    }

    .pro-qty11 .inc.qtybtn {
        background: #f1f1f1;
        color: #000;
        font-size: 16px;
        font-weight: 700;
        line-height: 1;
        padding: 0 10px;
        position: relative;
        z-index: 1;
        cursor: pointer;
    }

    /* BTN HOVER */
    .pro-qty11 .inc.qtybtn:hover {
        background: #ff6e40;
        color: #fff;
    }

    /* input */
    .pro-qty11 input {
        background: #f1f1f1;
        border: none;
        color: #000;
        font-size: 16px;
        font-weight: 700;
        line-height: 1;
        padding: 0 10px;
        text-align: center;
        width: 40px;
    }

    .primary-btn {
        background: #fc6132;
        border: none;
        display: block;
        /* text color */
        color: #fff;
        cursor: pointer;

    }

    /* btn hover */
    .primary-btn:hover {
        background: #fa4007;
        border: none;
        display: block;
        /* text color */
        color: #fff;
        cursor: pointer;
    }

</style>
</div>
