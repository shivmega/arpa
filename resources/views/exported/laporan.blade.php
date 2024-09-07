<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <h1>DATA LAPORAN</h1>
    <table border="1">
        <thead>
            <tr>
                
                <th>Institusi</th>
                <th>Nama</th>
                <th>Desa</th>
                <th>Periode</th>
                <th>Penyertaan Modal</th>
                <th>Omzet</th>
                <th>Pendapatan Bersih</th>
                <th>Kontribusi Pades</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporans as $laporan)
                <tr>
                    
                    <td>{{ $laporan->institusi }}</td>
                    <td>{{ $laporan->nama }}</td>
                    <td>
                        @foreach ($desas as $desa)
                            @if ($desa->id == $laporan->desa)
                                {{ $desa->nama_desa }}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $laporan->periode }}</td>
                    <td>{{ $laporan->penyertaan_modal }}</td>
                    <td>{{ $laporan->omzet }}</td>
                    <td>{{ $laporan->pendapatan_bersih }}</td>
                    <td>{{ $laporan->kontribusi_pades }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
