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
            @foreach ($karyawan as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $k->nama_karyawan }}</td>
                <td>{{ $k->tanggal_masuk }}</td>
                <td>{{ $k->waktu_masuk }}</td>
                <td>
                    <select class="form-select status-select" name="status" data-id="{{ $k->id }}">
                        <option selected disabled>Absensi</option>
                        <option value="masuk" {{ $k->status == 'masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="cuti" {{ $k->status == 'cuti' ? 'selected' : '' }}>Cuti</option>
                        <option value="sakit" {{ $k->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    </select>
                </td>
                <td>{{ $k->waktu_keluar }}</td>
                <td>
                    <button type="button" class="btn btn-success btn-size" data-bs-toggle="modal" data-bs-target="#modalFormKaryawan" data-mode="edit" data-id="{{ $k->id }}" data-nama_karyawan="{{ $k->nama_karyawan }}" data-tanggal_masuk="{{ $k->tanggal_masuk }}" data-waktu_masuk="{{ $k->waktu_masuk }}" data-status="{{ $k->status }}" data-waktu_keluar="{{ $k->waktu_keluar }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('karyawan.destroy', $k->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete btn-size" data-id="{{ $k->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>