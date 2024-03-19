<body>
    <h2>Cafe Indomart</h2>
    <h5>Jl. Arwinda Kp. Pateken Rt 03 Rw 03</h5>
    <hr>
    @isset($data['transaksi'])
    <h5>No. Faktur : {{ $data['transaksi']->id }}</h5>
    <h5>{{ $data['transaksi']->tanggal }}</h5>
    <table>
        <thead>
            <tr>
                <td>Qty</td>
                <td>Item</td>
                <td>Harga</td>
                <td>Sub Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach($data['transaksi']->detailTransaksi as $item)
            <tr>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->menu->nama_menu }}</td>
                <td>{{ number_format($item->menu->harga, 0, ",", ".") }}</td>
                <td>{{ number_format($item->sub_total, 0, ",", ".") }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan='3'>Total</td>
                <td>{{ number_format($data['transaksi']->total_harga, 0, ",", ".") }}</td>
            </tr>
        </tfoot>
    </table>
    @else
    <p>{{ $message }}</p>
    @endisset
</body>