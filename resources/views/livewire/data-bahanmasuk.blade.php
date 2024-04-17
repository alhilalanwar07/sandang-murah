<div>
    <div class="page-heading">
        <h3>Pembelian</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Pembelian </span>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Data</button>
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
                                        <label for="basicInput">Cari</label>
                                        <input type="text" class="form-control" id="basicInput" placeholder="Cari" wire:model="search">
                                    </div>
                                </div>
                                {{-- perpage --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Per Page</label>
                                        <select class="form-select" wire:model="perPage">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                            <th>Supplier</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Expired</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stoks as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-wrap" width="20%">{{ $item->nama_produk }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ $item->total_harga }}</td>
                                            <td>{{ $item->supplier }}</td>
                                            <td>{{ $item->tanggal_beli }}</td>
                                            <td>{{ $item->tanggal_expired }}</td>
                                            <td>
                                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit" wire:click="stokId({{ $item->id }})">Edit</button>
                                                <button class="btn btn-danger" wire:click="delete({{ $item->id }})">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {{ $stoks->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- modal tambah --}}
    <div wire:ignore.self class="modal fade text-left" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Data</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form wire:submit.prevent="store">
                    <div class="modal-body p-3">
                        <div class="form-group mb-3">
                            <label for="basicInput">Nama Barang</label>
                            <select class="form-select" wire:model="barang_id">
                                <option value="">Pilih Barang</option>
                                @foreach ($barangs as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                                @endforeach
                            </select>
                            @error('barang_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Jumlah</label>
                            <input type="number" class="form-control" id="basicInput" placeholder="Jumlah" wire:model="jumlah">
                            @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Total Harga</label>
                            <input type="number" class="form-control" id="basicInput" placeholder="Total Harga" wire:model="total_harga">
                            @error('total_harga') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Supplier</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Supplier" wire:model="supplier">
                            @error('supplier') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="basicInput" placeholder="Tanggal Masuk" wire:model="tanggal_beli">
                            @error('tanggal_beli') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Tanggal Expired</label>
                            <input type="date" class="form-control" id="basicInput" placeholder="Tanggal Expired" wire:model="tanggal_expired">
                            @error('tanggal_expired') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div wire:ignore.self class="modal fade text-left" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Edit Data</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="form-group mb-3">
                        <label for="basicInput">Nama Barang</label>
                        <select class="form-select" wire:model="barang_id">
                            <option value="">Pilih barang</option>
                            @foreach ($barangs as $item)
                            <option value="{{ $item->barang_id }}">{{ $item->nama_produk }}</option>
                            @endforeach
                        </select>
                        @error('barang_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Jumlah</label>
                        <input type="number" class="form-control" id="basicInput" placeholder="Jumlah" wire:model="jumlah">
                        @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Total Harga</label>
                        <input type="number" class="form-control" id="basicInput" placeholder="Total Harga" wire:model="total_harga">
                        @error('total_harga') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Supplier</label>
                        <input type="text" class="form-control" id="basicInput" placeholder="Supplier" wire:model="supplier">
                        @error('supplier') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="basicInput" placeholder="Tanggal Masuk" wire:model="tanggal_beli">
                        @error('tanggal_beli') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Tanggal Expired</label>
                        <input type="date" class="form-control" id="basicInput" placeholder="Tanggal Expired" wire:model="tanggal_expired">
                        @error('tanggal_expired') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" wire:click="update()">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
