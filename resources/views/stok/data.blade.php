<div class="mt-4">
    <table class="table table-hover rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Menu Id</th>
                <th>Jumlah</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stok as $index => $s)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $s->menu->nama_menu }}</td>
                <td>{{ $s->jumlah }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormStok" data-mode="edit" data-id="{{ $s->id }}" data-menu_id="{{ $s->menu_id }}" data-jumlah="{{ $s->jumlah }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('stok.destroy', $s->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete btn-size" data-id="{{ $s->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>