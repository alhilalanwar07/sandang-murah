<div>
    <div class="page-heading">
        <h3>Penjualan</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Penjualan </span>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                {{-- alert --}}
                                @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Cari Data</label>
                                        <input type="text" class="form-control" placeholder="Cari Data" wire:model="search">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Jumlah Data</label>
                                        <select class="form-select" wire:model="perPage">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pesanan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Tanggal Pesanan</th>
                                            <th>Total Harga</th>
                                            <th>Status Pesanan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penjualans as $penjualan)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $penjualan->kode_pesanan }}</td>
                                            <td>{{ $penjualan->nama_pelanggan }}</td>
                                            <td>{{ Carbon\Carbon::parse($penjualan->created_at)->isoFormat('dddd, D MMMM Y') }}</td>
                                            <td>Rp. {{ number_format($penjualan->total_harga1) }},-</td>
                                            <td>{{ $penjualan->status_pesanan }}</td>
                                            <td>
                                                @if ($penjualan->status_pesanan == 'menunggu')
                                                <button class="btn btn-sm mr-1 mb-1 btn-success" wire:click="konfirmasi({{ $penjualan->id }})">Konfirmasi</button>
                                                {{-- batalkan --}}
                                                <button class="btn btn-sm mr-1 mb-1 btn-danger" wire:click="batalkan({{ $penjualan->id }})">Batalkan</button>
                                                @elseif ($penjualan->status_pesanan == 'diproses')
                                                <button class="btn btn-sm mr-1 mb-1 btn-success" wire:click="diproses({{ $penjualan->id }})">Dikirim</button>
                                                @elseif ($penjualan->status_pesanan == 'dikirim')
                                                <button class="btn btn-sm mr-1 mb-1 btn-success" wire:click="dikirim({{ $penjualan->id }})">Selesai</button>
                                                @endif
                                                <button class="btn btn-sm mr-1 mb-1 btn-primary" wire:click="detail({{ $penjualan->id }})" data-bs-toggle="modal" data-bs-target="#detailPenjualan">Detail</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                            {{-- pagiante --}}
                            <div class="row">
                                <div class="col-md-12">
                                    {{ $penjualans->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- modal --}}
    <div wire:ignore.self class="modal fade text-left" id="detailPenjualan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="table-responsive">
                        <table class="table mr-2 ml-2">
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
                    <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
