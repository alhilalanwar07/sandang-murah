<div>
    <!-- Breadcrumb Section Begin -->
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Produk</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-dark justify-content-center">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produk</li>
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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($produks as $produk)
                <div class="col" style="transition: all 0.3s ease;">
                    <div class="card shadow-sm" style="transition: all 0.3s ease;" onmouseover="this.style.boxShadow='0px 0px 15px rgba(0,0,0,0.3)';" onmouseout="this.style.boxShadow='0px 0px 0px rgba(0,0,0,0)';">
                        <img src="{{url('/')}}/{{ $produk->gambar1 }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6 class="card-title" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $produk->nama_produk }}">{{ Str::limit($produk->nama_produk, 20, '...') }}</h6>
                                <h6 class="card-text"><span class="badge bg-success">Rp. {{ number_format($produk->harga) }}</span></h6>
                            </div>
                            <div class="text-center mt-4">
                                <div class="btn-group btn-block">
                                    {{-- <a href="#" class="btn btn-sm btn-outline-warning">Detail</a> --}}
                                    <button wire:click="goToCart({{ $produk->id }})" class="btn btn-sm btn-outline-warning">Beli</button>
                                    <button wire:click="addToCart({{ $produk->id }})" class="btn btn-sm btn-outline-success">Keranjang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $produks->links() }}
            </div>
        </div>
    </section>
</div>
