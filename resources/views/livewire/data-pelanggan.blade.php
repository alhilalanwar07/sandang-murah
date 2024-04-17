<div>
    <div class="page-heading">
        <h3>Data Pelanggan</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Data Pelanggan </span>
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
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No Telp</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pelanggans as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ asset('/'.$item->gambar) }}" alt="" width="100px">
                                            </td>
                                            <td>{{ $item->nama_pelanggan }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->no_telp }}</td>
                                            <td>
                                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit" wire:click="pelangganId({{ $item->id }})">Edit</button>
                                                <button class="btn btn-danger" wire:click="delete({{ $item->id }})">Hapus</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- paginate --}}
                            <div class="d-flex justify-content-end">
                                {{ $pelanggans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- modal edit --}}
    <div wire:ignore.self class="modal fade text-left" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Edit Data Pelanggan</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body p-3">
                    <div class="form-group mb-3">
                        <label for="basicInput">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" wire:model="nama_pelanggan">
                        @error('nama_pelanggan') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Alamat</label>
                        <textarea class="form-control" placeholder="Alamat" wire:model="alamat"></textarea>
                        @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">No Telp</label>
                        <input type="text" class="form-control" placeholder="No Telp" wire:model="no_telp">
                        @error('no_telp') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Email</label>
                        <input type="text" class="form-control" placeholder="Email" wire:model="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    {{-- mg upload --}}
                    <div class="form-group mb-3">
                        <label for="basicInput">Foto</label>
                        <input type="file" class="form-control" wire:model="gambar">
                        @error('gambar') <span class="text-danger">{{ $message }}</span> @enderror
                        {{-- img preview --}}
                        @if ($gambar)
                        <img src="{{ $gambar->temporaryUrl() }}" width="120px">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">

                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Update</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal tambah --}}
    <div wire:ignore.self class="modal fade text-left" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Data Pelanggan</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body p-3">
                    <div class="form-group mb-3">
                        <label for="basicInput">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap" wire:model="nama_pelanggan">
                        @error('nama_pelanggan') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Alamat</label>
                        <textarea class="form-control" placeholder="Alamat" wire:model="alamat"></textarea>
                        @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">No Telp</label>
                        <input type="text" class="form-control" placeholder="No Telp" wire:model="no_telp">
                        @error('no_telp') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="basicInput">Email</label>
                        <input type="text" class="form-control" placeholder="Email" wire:model="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    {{-- password --}}
                    <div class="form-group mb-3">
                        <label for="basicInput">Password</label>
                        <input type="password" class="form-control" placeholder="Password" wire:model="password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    {{-- mg upload --}}
                    <div class="form-group mb-3">
                        <label for="basicInput">Foto</label>
                        <input type="file" class="form-control mb-2" wire:model="gambar">
                        @error('gambar') <span class="text-danger">{{ $message }}</span> @enderror
                        {{-- img preview --}}
                        @if ($gambar)
                        <img src="{{ $gambar->temporaryUrl() }}" width="120px">
                        @endif
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">

                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
