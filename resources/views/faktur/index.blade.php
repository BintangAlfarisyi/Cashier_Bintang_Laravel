<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Bintang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container d-flexx justify-content-center" style="flex-direction: column; width: 400px;">
        <div class="text-center">
            <h2>Cashier Bintang</h2>
            <h5>Jl. Arwinda Kp. Pateken Rt 03 Rw 03</h5>
            <hr>
            <h5>No. Faktur : {{ $data['transaksi']->id }}</h5>
            <h5>{{ $data['transaksi']->tanggal }}</h5>
        </div>
        <hr>
        @foreach($data['transaksi']->detailTransaksi as $item)
        <div class="data">
            <div class="nama">
                <p class="m-0">{{ $item->menu->nama_menu }}</p>
            </div>
            <div class="harga d-flex justify-content-between">
                <p class="m-0">{{ number_format($item->menu->harga, 0, ",", ".") }} x {{ $item->jumlah }}</p>
                <p class="m-0">{{ number_format($item->sub_total, 0, ",", ".") }}</p>
            </div>
        </div>
        @endforeach
        <hr>
        <div class="total d-flex justify-content-between">
            <h4>Total</h4>
            <h4>{{ number_format($data['transaksi']->total_harga, 0, ",", ".") }} </h4>
        </div>
        <div class="text-center mt-5">
            <p>Terimakasih sudah berbelanja di Cashier Bintang silahkan kembali lagi!</p>
            <p>~~ SELAMAT JALAN ~~</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>