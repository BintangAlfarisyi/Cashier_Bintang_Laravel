<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>Ponsel</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggan as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nama_pelanggan }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->ponsel }}</td>
                <td>{{ $p->alamat }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormPelanggan" data-mode="edit" data-id="{{ $p->id }}" data-nama_pelanggan="{{ $p->nama_pelanggan }}" data-email="{{ $p->email }}" data-ponsel="{{ $p->ponsel }}" data-alamat="{{ $p->alamat }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('pelanggan.destroy', $p->id) }}" method="post" class="d-inline">
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