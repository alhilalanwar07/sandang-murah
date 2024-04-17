<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    {{-- bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <div class="container mb-2">
        <div class="row">
            <div class="col-md-12">
                <div class="text-left">
                    {{-- <img src="{{ url('/') }}/assets1/img/siroti.png" alt="karunia mandiri" width="200px"><br>
                    <span class="mt-2 text-uppercase">Pabrik Roti Karunia Mandiri</span><br>
                    <span class="mt-0">Jl. Kancil, No.17 B, Kelurahan Andonohu, Kota Kendari</span> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- judul --}}
    <div class="container mt-3 mb-2">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h5>Laporan Penjualan</h5>
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
                            <th>Tanggal</th>
                            <th>Kode Pesanan</th>
                            <th>Total Harga</th>
                            <th>Status Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->kode_pesanan }}</td>
                            <td>{{ $item->total_harga1 }}</td>
                            <td>{{ $item->status_pesanan }}</td>
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
