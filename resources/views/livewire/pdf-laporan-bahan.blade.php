<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pembelian Barang</title>
    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    {{-- leaflet --}}

</head>
<body>
    <div class="container mb-2">
        <div class="row">
            <div class="col-md-12">
                <div class="text-left">
                    {{-- <img src="{{ url('/') }}/assets1/img/sandang_murah_logo.png" alt="" width="100px"> --}}
                    {{-- <span class="mt-2 text-uppercase">Sandang Murah</span><br>
                    <span class="mt-0">JL. Kenanga No.59, Sea, Kec. Latambaga</span> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- judul --}}
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h5>Laporan Pembelian Barang</h5>
                    {{-- tanggal cetak --}}
                    <span>Tanggal Cetak : {{ date('d-m-Y') }}</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <br>

    {{-- footer --}}
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Masuk</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bahans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ Carbon\Carbon::parse($item->tanggal_beli)->isoFormat('dddd, D MMMM Y') }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp. {{ number_format($item->total_harga) }},-</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    {{-- bootstrap --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    {{-- leaflet --}}

</body>
</html>
