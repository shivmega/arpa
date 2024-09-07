<!DOCTYPE html>
<html>

<head>
    
</head>

<body>
<h1>DATA BUMDESA</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Desa</th>
                <th>Nama Direktur</th>
                <th>Aktifitas</th>
                <th>Desa</th>
                <th>Tahun Berdiri</th>
                <th>Status Hukum</th>
                <th>Kategori</th>
                <th>Alamat</th>
                <th>Jumlah Pekerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bumdesas as $bumdesa)
                <tr>
                    <td>{{ $bumdesa->nama_bumdesa }}</td>
                    <td>{{ $bumdesa->nama_direktur }}</td>
                    <td>{{ $bumdesa->aktifitas }}</td>
                    @foreach ($desas as $desa)
                        @if ($desa->id == $bumdesa->desa)
                            <td>{{ $desa->nama_desa }}</td>
                        @endif
                    @endforeach
                    <td>{{ $bumdesa->tahun_berdiri }}</td>
                    <td>{{ $bumdesa->status_hukum }}</td>
                    <td>{{ $bumdesa->kategori }}</td>
                    <td>{{ $bumdesa->alamat }}</td>
                    <td>{{ $bumdesa->jumlah_pekerja }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
