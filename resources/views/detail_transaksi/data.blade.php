<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Transaksi Id</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail_transaksi as $index => $d)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $d->transaksi_id }}</td>
                <td>{{ $d->menu->nama_menu }}</td>
                <td>{{ $d->jumlah }}</td>
                <td>{{ $d->sub_total }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormDetailTransaksi" data-mode="edit" data-id="{{ $d->id }}" data-transaksi_id="{{ $d->transaksi_id }}" data-menu_id="{{ $d->menu_id }}" data-jumlah="{{ $d->jumlah }}" data-sub_total="{{ $d->sub_total }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('detail_transaksi.destroy', $d->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete btn-size" data-id="{{ $d->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>