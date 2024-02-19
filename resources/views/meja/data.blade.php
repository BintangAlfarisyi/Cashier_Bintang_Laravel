<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor Meja</th>
                <th>Kapasitas</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meja as $index => $m)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $m->no_meja }}</td>
                <td>{{ $m->kapasitas }}</td>
                <td>{{ $m->status }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormMeja" data-mode="edit" data-id="{{ $m->id }}" data-no_meja="{{ $m->no_meja }}" data-kapasitas="{{ $m->kapasitas }}" data-status="{{ $m->status }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('meja.destroy', $m->id) }}" method="post" class="d-inline">
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