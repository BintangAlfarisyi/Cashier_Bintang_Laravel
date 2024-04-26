<table id="data">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Menu</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Keterangan</th>
            <th>Jenis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $m)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $m->nama_menu }}</td>
            <td>{{ $m->harga }}</td>
            <td>Gambar tidak bisa diexport</td>
            <td>{{ $m->keterangan }}</td>
            <td>{{ $m->jenis->nama_jenis }}</td>
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
        background-color: #17cfb6;
        color: white;
    }
</style>