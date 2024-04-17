<div>
    <div class="page-heading">
        <h3>Data Bahan</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Data Bahan </span>
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
                                            <th>Gambar</th>
                                            <th>Nama Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bahans as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('/'.$item->gambar) }}" alt="" width="80px">
                                            </td>
                                            <td>{{ $item->nama_bahan }}</td>
                                            <td style="width: 20%">
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit" wire:click="bahanId({{ $item->id }})">Edit</button>
                                                <button class="btn btn-danger" wire:click="delete({{ $item->id }})">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                    <h5 class="modal-title" id="myModalLabel1">Tambah Data Kategori</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form wire:submit.prevent="store" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="basicInput">Nama Bahan</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Nama Bahan" wire:model="nama_bahan">
                            @error('nama_bahan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Stok</label>
                            <input type="number" class="form-control" id="basicInput" placeholder="Stok" wire:model="stok">
                            @error('stok') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Harga</label>
                            <input type="number" class="form-control" id="basicInput" placeholder="Harga" wire:model="harga">
                            @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Gambar</label>
                            <input type="file" class="form-control mb-2" id="basicInput" placeholder="Gambar" wire:model="gambar">
                            @error('gambar') <span class="text-danger">{{ $message }}</span> @enderror
                            @if ($gambar)
                            <img src="{{ $gambar->temporaryUrl() }}" alt="" width="100px">
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">

                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div wire:ignore.self class="modal fade text-left" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Edit Data Bahan</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <form wire:submit.prevent="update" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="basicInput">Nama Bahan</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Nama Bahan" wire:model="nama_bahan">
                            @error('nama_bahan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Stok</label>
                            <input type="number" class="form-control" id="basicInput" placeholder="Stok" wire:model="stok">
                            @error('stok') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Harga</label>
                            <input type="number" class="form-control" id="basicInput" placeholder="Harga" wire:model="harga">
                            @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Satuan</label>
                            <input type="text" class="form-control" id="basicInput" placeholder="Satuan" wire:model="satuan">
                            @error('satuan') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="basicInput">Gambar</label>
                            <input type="file" class="form-control mb-2" id="basicInput" placeholder="Gambar" wire:model="gambar">
                            @error('gambar') <span class="text-danger">{{ $message }}</span> @enderror
                            @if ($gambar)
                            <img src="{{ $gambar->temporaryUrl() }}" alt="" width="100px">
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">

                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
