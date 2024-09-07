<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h1>DATA DESA</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Desa</th>
                <th>Kepala Desa</th>
                <th>Sekretaris Desa</th>
                <th>Perangkat Desa</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Jumlah Penduduk</th>
                <th>Alamat</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($desas as $desa)
                <tr>
                    <td>{{ $desa->nama_desa }}</td>
                    <td>{{ $desa->nama_kades }}</td>
                    <td>{{ $desa->nama_sekdes }}</td>
                    <td>{{ $desa->nama_perangkat_desa }}</td>
                    <td>{{ $desa->kecamatan }}</td>
                    <td>{{ $desa->kabupaten }}</td>
                    <td>{{ $desa->jumlah_penduduk }}</td>
                    <td>{{ $desa->alamat }}</td>
                    <td>{{ $desa->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
