<div class="mt-4">
    <table class="table table-hover rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Nama Supplier</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $index => $p)
            <tr>    
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nama_produk }}</td>
                <td>{{ $p->nama_supplier }}</td>
                <td>{{ $p->harga_beli }}</td>
                <td>{{ $p->harga_jual }}</td>
                <td class="editable" data-id="{{ $p->id }}" data-field="stok">{{ $p->stok }}</td>
                <td>{{ $p->keterangan }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormProduk" data-mode="edit" data-id="{{ $p->id }}" data-nama_produk="{{ $p->nama_produk }}" data-nama_supplier="{{ $p->nama_supplier }}" data-harga_beli="{{ $p->harga_beli }}" data-harga_jual="{{ $p->harga_jual }}" data-stok="{{ $p->stok }}" data-keterangan="{{ $p->keterangan }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('produk.destroy', $p->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete btn-size" data-id="{{ $p->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>