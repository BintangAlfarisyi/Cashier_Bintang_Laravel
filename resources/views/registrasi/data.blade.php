<div class="mt-4">
    <table class="table table-hover rounded overflow-hidden" id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Level</th>
                <th>Alamat</th>
                <th>Ponsel</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Membuat Variable index -->
            @php
            $index = 1;
            @endphp
            @foreach ($user as $r)
            @if($r->level != 1)
            <tr>
                <!-- Menampilkan Variable index -->
                <td>{{ $index }}</td>
                <td>{{ $r->name }}</td>
                <td>{{ $r->email }}</td>
                <td>Password dienkripsi</td>
                <td>
                    @if($r->level == 2)
                    Kasir
                    @endif
                </td>
                <td>{{ $r->alamat }}</td>
                <td>{{ $r->ponsel }}</td>
                <td>
                    <form action="{{ route('registrasi.destroy', $r->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete btn-size" data-id="{{ $r->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            <!-- Menambah index ketika ada data baru -->
            @php
            $index++;
            @endphp
            @endif
            @endforeach
        </tbody>
    </table>
</div>