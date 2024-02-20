<div class="mt-4">
    <table class="table table-striped rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pemesan</th>
                <th>Tanggal Pemesanan</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Jumlah Pelanggan</th>
                <th>Meja Id</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemesanan as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nama_pemesan }}</td>
                <td>{{ $p->tanggal_pemesanan }}</td>
                <td>{{ $p->jam_mulai }}</td>
                <td>{{ $p->jam_selesai }}</td>
                <td>{{ $p->jumlah_pelanggan }}</td>
                <td>{{ $p->meja_id }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormPemesanan" data-mode="edit" data-id="{{ $p->id }}" data-meja_id="{{ $p->meja_id }}" data-tanggal_pemesanan="{{ $p->tanggal_pemesanan }}" data-jam_mulai="{{ $p->jam_mulai }}" data-jam_selesai="{{ $p->jam_selesai }}" data-nama_pemesan="{{  $p->nama_pemesan }}" data-jumlah_pelanggan="{{ $p->jumlah_pelanggan }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('pemesanan.destroy', $p->id) }}" method="post" class="d-inline">
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