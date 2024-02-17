<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Keterangan</th>
                <th>Jenis Id</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menu as $index => $m)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $m->nama_menu }}</td>
                <td>{{ $m->harga }}</td>
                <td>{{ $m->gambar }}</td>
                <td>{{ $m->keterangan }}</td>
                <td>{{ $m->jenis_id }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormMenu" data-mode="edit" data-id="{{ $m->id }}" data-nama_menu="{{ $m->nama_menu }}" data-harga="{{ $m->harga }}" data-gambar="{{ $m->gambar }}" data-keterangan="{{ $m->keterangan }}" data-jenis_id="{{ $m->jenis_id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('menu.destroy', $m->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete btn-size" data-id="{{ $m->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>