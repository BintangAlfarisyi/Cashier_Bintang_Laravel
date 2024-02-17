<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Jenis</th>
                <th>Kategori Id</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jenis as $index => $j)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $j->nama_jenis }}</td>
                <td>{{ $j->kategori_id }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormJenis" data-mode="edit" data-id="{{ $j->id }}" data-nama_jenis="{{ $j->nama_jenis }}" data-kategori_id="{{ $j->kategori_id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('jenis.destroy', $j->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete btn-size" data-id="{{ $j->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>