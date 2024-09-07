<!DOCTYPE html>
<html>

<head>
    
</head>

<body>
<h1>DATA UMKM</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nama UMKM</th>
                <th>Produk</th>
                <th>Desa</th>
                <th>Pemilik UMKM</th>
                <th>Tahun Berdiri</th>
                <th>Jangkauan Pasar</th>
                <th>Omset</th>
                <th>Jumlah Pekerja</th>
                <th>Alamat</th>
                <th>Keterangan</th>
                <th>Kontak</th>
                <th>Pasar Online</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($umkms as $umkm)
                <tr>
                    <td>{{ $umkm->nama_umkm }}</td>
                    <td>{{ $umkm->produk }}</td>
                    <td>
                        @foreach ($desas as $desa)
                            @if ($desa->id == $umkm->desa)
                                {{ $desa->nama_desa }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$umkm->pemilik_umkm}}</td>
                    <td>{{ $umkm->tahun_berdiri }}</td>
                    <td>{{ $umkm->jangkauan_pasar }}</td>
                    <td>{{$umkm->omset}}</td>
                    <td>{{ $umkm->jumlah_pekerja }}</td>
                    <td>{{ $umkm->alamat }}</td>
                    <td>{{ $umkm->keterangan }}</td>
                    <td>{{ $umkm->kontak }}</td>
                    <td>{{$umkm->pasar_online}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
