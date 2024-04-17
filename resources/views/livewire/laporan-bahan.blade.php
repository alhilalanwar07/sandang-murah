<div>
    <div class="page-heading">
        <h3>Laporan Stok Barang</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-flex justify-content-between">
                            <span>Laporan Stok Barang </span>
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" wire:poll.3000ms>
                                        <strong>Gagal!</strong> {{ session('error') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    {{-- date --}}
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Tanggal Awal</label>
                                        <input type="date" class="form-control" wire:model="tanggal_awal">
                                        @error('tanggal_awal') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    {{-- date --}}
                                    <div class="form-group mb-3">
                                        <label for="basicInput">Tanggal Akhir</label>
                                        <input type="date" class="form-control" wire:model="tanggal_akhir">
                                        @error('tanggal_akhir') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        {{-- btn cetak --}}
                                        <button class="btn btn-primary btn-block" wire:click="cetak">Cetak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>
