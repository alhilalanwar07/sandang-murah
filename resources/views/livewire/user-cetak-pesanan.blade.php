<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Laporan Penjualan</title>
        {{-- bootstrap --}}
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <div class="container mb-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-left">
                        <img
                            src="{{ url('/') }}/assets1/img/siroti.png"
                            alt="karunia mandiri"
                            width="200px"
                        /><br />
                        <span class="mt-2 text-uppercase"
                            >Pabrik Roti Karunia Mandiri</span
                        ><br />
                        <span class="mt-0"
                            >Jl. Kancil, No.17 B, Kelurahan Andonohu, Kota
                            Kendari</span
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-3 mb-2">
            @foreach ($pesanans as $pesanans)
            <div class="row">
                <div class="col-md-5">
                    <table class="table table-borderless">
                        <tbody
                            align="left"
                            style="line-height: 0.3; font-size: 12px"
                            ;
                        >
                            <td>
                                <tr>
                                    <td>Kode Pesanan</td>
                                    <td style="width: 6px">:</td>
                                    <td>{{ $pesanans->kode_pesanan }}</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td style="width: 6px">:</td>
                                    <td>{{ $pesanans->name }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td style="width: 6px">:</td>
                                    <td>{{ $pesanans->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>No. Telp</td>
                                    <td style="width: 6px">:</td>
                                    <td>{{ $pesanans->no_telp }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td style="width: 6px">:</td>
                                    <td>
                                        {{ Carbon\Carbon::parse($pesanans->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Bayar</td>
                                    <td style="width: 6px">:</td>
                                    <td>
                                        Rp.
                                        {{ strrev(implode('.',str_split(strrev(strval($pesanans->total_harga1)),3))) }}
                                    </td>
                                </tr>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
        {{-- footer --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table
                            class="table table-bordered border-dark"
                            style="border: 1px solid black"
                        >
                            <thead class="fw-bold" style="font-size: 12px">
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 12px">
                                @foreach ($detail_pesanans2 as $pesanan_detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pesanan_detail->nama_produk }}</td>
                                    <td>
                                        Rp.
                                        {{ strrev(implode('.',str_split(strrev(strval($pesanan_detail->harga)),3))) }}
                                    </td>
                                    <td>{{ $pesanan_detail->jumlah }}</td>
                                    <td>
                                        Rp.
                                        {{ strrev(implode('.',str_split(strrev(strval($pesanan_detail->total_harga)),3))) }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- jquery --}}
        <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"
        ></script>
        {{-- bootstrap --}}
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"
        ></script>
        {{-- leaflet --}}
    </body>
</html>
