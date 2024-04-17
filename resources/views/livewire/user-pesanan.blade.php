<div>
    <!-- Breadcrumb Section Begin -->
    <section class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Pesanan</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-dark justify-content-center">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad pt-3">
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
                    {{-- alert warning --}}
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </symbol>
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>

                    <div class="alert alert-primary d-flex align-items-center border-bottom" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                            <use xlink:href="#info-fill" /></svg>
                        <div>
                            Pembayaran dilakukan setelah Anda menerima pesanan.
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pesanan</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Total Bayar</th>
                                    <th>Status Pesanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesanans as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-uppercase">{{ $p->kode_pesanan }}</td>
                                    <td>{{ Carbon\Carbon::parse($p->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td>Rp. {{ number_format($p->total_harga1) }}</td>
                                    <td>{{ ucfirst($p->status_pesanan) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailPesanan1" wire:click.prevent="detail({{ $p->id }})">Detail</button>
                                        @if($p->status_pesanan == 'menunggu')
                                        <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="batal({{ $p->id }})">Batalkan</button>
                                        @elseif($p->status_pesanan == 'selesai')
                                        <button type="button" class="btn btn-success btn-sm" wire:click.prevent="cetak({{ $p->id }})">Cetak</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- pagiante --}}
                    <div class="row">
                        <div class="col-md-12">
                            {{ $pesanans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="detailPesanan1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-bs-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detail_pesanans1 as $dp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dp->nama_produk }}</td>
                                    <td>Rp. {{ number_format($dp->harga) }}</td>
                                    <td>{{ $dp->jumlah }}</td>
                                    <td>Rp. {{ number_format($dp->total_harga) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- total bayar --}}
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="text-uppercase">Total Bayar</h5>
                                            </div>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3 align-items-end">
                                                @php
                                                $total_harga = 0;
                                                foreach($detail_pesanans1 as $dp){
                                                $total_harga += $dp->total_harga;
                                                }
                                                @endphp
                                                <h5 class="text-uppercase">Rp. {{ number_format($total_harga) }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
