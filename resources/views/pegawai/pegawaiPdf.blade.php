<table id="data">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Tanggal Masuk</th>
            <th>Waktu Masuk</th>
            <th>Status</th>
            <th>Waktu Keluar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $j)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $j->nama_karywan }}</td>
            <td>{{ $j->tanggal_masuk }}</td>
            <td>{{ $j->waktu_masuk }}</td>
            <td>{{ $j->status }}</td>
            <td>{{ $j->waktu_keluar }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<style>
    #data {
        font-family: "Montserrat", sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #data td,
    #data th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #data th {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
        background-color: #7391ff;
        color: white;
    }
</style>