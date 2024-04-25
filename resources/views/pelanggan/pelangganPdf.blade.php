<table id="data">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Email</th>
            <th>Telpon</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $j)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $j->nama_pelanggan }}</td>
            <td>{{ $j->email }}</td>
            <td>{{ $j->ponsel }}</td>
            <td>{{ $j->alamat }}</td>
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