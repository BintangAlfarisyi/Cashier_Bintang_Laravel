<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Transaksi Id</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Metode Pembayaran</th>
                <th>Keterangan</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $index => $t)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $t->id }}</td>
                <td>{{ $t->tanggal }}</td>
                <td>{{ $t->total_harga }}</td>
                <td>{{ $t->metode_pembayaran }}</td>
                <td>{{ $t->keterangan }}</td>
                <!-- <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormTransaksi" data-mode="edit" data-id="{{ $t->id }}" data-tanggal="{{ $t->tanggal }}" data-total_harga="{{ $t->total_harga }}" data-metode_pembayaran="{{ $t->metode_pembayaran }}" data-keterangan="{{ $t->keterangan }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('transaksi.destroy', $t->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete btn-size" data-id="{{ $t->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>