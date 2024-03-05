<body>
    <h2>Cafe Indomart</h2>
    <h5>Jl. Arwinda Kp. Pateken Rt 03 Rw 03</h5>
    <hr>
    <h5>No. Faktur : {{ $transaksi->id }}</h5>
    <h5>{{ $transaksi->tanggal }}</h5>
    <table>
        <thead>
            <tr>
                <td>Qty</td>
                <td>Item</td>
                <td>Harga</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->detailTransaksi as $item)
            <tr>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->menu->nama_menu }}</td>
                <td>{{ number_format($item->menu->harga, 0, ",", ".") }}</td>
                <td>{{ number_format($item->subTotal, 0, ",", ".") }}</td>
            </tr>
            @endforeach
        </tbody>
        <tFoot>
            <tr>
                <td colspan='3'>Total</td>
                <td>{{ number_format($transaksi->total_harga, 0, ",", ".") }}</td>
            </tr>
        </tFoot>
    </table>
</body>