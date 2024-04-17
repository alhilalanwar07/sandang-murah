<div>
    <div class="page-heading">
        <h3>Produksi</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Produksi</span>
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
                                            <th>Nama Produk</th>
                                            <th>Jumlah Produksi</th>
                                            <th>Total Produksi</th>
                                            <th>Tanggal Produksi</th>
                                            <th>Tanggal Kadaluarsa</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produksis as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_produk }}</td>
                                            <td>{{ $item->jumlah_produksi }}x</td>
                                            <td>{{ $item->total_produksi }} buah</td>
                                            <td>{{ $item->tanggal_produksi }}</td>
                                            <td>{{ $item->tanggal_expired }}</td>
                                            <td>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit" wire:click="produksiId({{ $item->id }})">Edit</button>
                                                <button class="btn btn-danger" wire:click="delete({{ $item->id }})">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {{ $produksis->links() }}
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
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Data</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="form-group mb-3">
                        <label for="basicInput">Nama Produk</label>
                        <select class="form-select" wire:model="produk_id">
                            <option value="">Pilih Produk</option>
                            @foreach ($produks as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                            @endforeach
                        </select>
                        @error('produk_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Jumlah Produksi (X Produksi)</label>
                        <input type="number" class="form-control" id="basicInput" placeholder="Jumlah Produksi" wire:model="jumlah_produksi">
                        @error('jumlah_produksi') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Total Produksi (Buah)</label>
                        <input type="number" class="form-control" id="basicInput" placeholder="0" wire:model="total_produksi" disabled value="{{ $total_produksi }}">
                        @error('total_produksi') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Tanggal Produksi</label>
                        <input type="date" class="form-control" id="basicInput" placeholder="Tanggal Produksi" wire:model="tanggal_produksi">
                        @error('tanggal_produksi') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" id="basicInput" placeholder="Tanggal Kadaluarsa" wire:model="tanggal_expired">
                        @error('tanggal_expired') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" wire:click="store">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div wire:ignore.self class="modal fade text-left" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Edit Data</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <div class="form-group mb-3">
                        <label for="basicInput">Nama Produk</label>
                        <select class="form-select" wire:model="produk_id">
                            <option value="">Pilih Produk</option>
                            @foreach ($produks as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                            @endforeach
                        </select>
                        @error('produk_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Jumlah Produksi (X Produksi)</label>
                        <input type="number" class="form-control" id="basicInput" placeholder="Jumlah Produksi" wire:model="jumlah_produksi">
                        @error('jumlah_produksi') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Total Produksi (Buah)</label>
                        <input type="number" class="form-control" id="basicInput" placeholder="0" wire:model="total_produksi" disabled value="{{ $total_produksi }}">
                        @error('total_produksi') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Tanggal Produksi</label>
                        <input type="date" class="form-control" id="basicInput" placeholder="Tanggal Produksi" wire:model="tanggal_produksi">
                        @error('tanggal_produksi') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" id="basicInput" placeholder="Tanggal Kadaluarsa" wire:model="tanggal_expired">
                        @error('tanggal_expired') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1" wire:click="update">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
