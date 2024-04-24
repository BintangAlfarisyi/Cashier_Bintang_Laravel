<div class="mt-4">
    <table class="table table-hover rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Karyawan</th>
                <th>Tanggal Masuk</th>
                <th>Waktu Masuk</th>
                <th>Status</th>
                <th>Waktu Keluar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawai as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nama_karyawan }}</td>
                <td>{{ $p->tanggal_masuk }}</td>
                <td>{{ $p->waktu_masuk }}</td>
                <td>
                    <select class="form-select status-select" name="status" data-id="{{ $p->id }}">
                        <option selected disabled>Absensi</option>
                        <option value="masuk" {{ $p->status == 'masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="cuti" {{ $p->status == 'cuti' ? 'selected' : '' }}>Cuti</option>
                        <option value="sakit" {{ $p->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    </select>
                </td>
                <td>{{ $p->waktu_keluar }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormPegawai" data-mode="edit" data-id="{{ $p->id }}" data-nama_karyawan="{{ $p->nama_karyawan }}" data-tanggal_masuk="{{ $p->tanggal_masuk }}" data-waktu_masuk="{{ $p->waktu_masuk }}" data-status="{{ $p->status }}" data-waktu_keluar="{{ $p->waktu_keluar }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('pegawai.destroy', $p->id) }}" method="post" class="d-inline">
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