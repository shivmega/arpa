<?php

namespace App\Exports;

use App\Models\Desa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DesaExport implements WithHeadings, WithMapping, FromView
{
    public function view(): View
    {
        return view('exported.desa', [
            'desas' => Desa::all()
        ]);
    }
    public function map($desa): array
    {
        return [
            $desa->id,
            $desa->nama_desa,
            $desa->nama_kades,
            $desa->nama_perangkat_desa,
            $desa->nama_sekdes,
            $desa->kecamatan,
            $desa->kabupaten,
            $desa->jumlah_penduduk,
            $desa->alamat,
            $desa->keterangan,
            $desa->timestamp
        ];
    }
    public function headings(): array
    {
        return [
        'id',
        'nama_desa',
        'nama_kades',
        'nama_perangkat_desa',
        'nama_sekdes',
        'kecamatan',
        'kabupaten',
        'jumlah_penduduk',
        'alamat',
        'keterangan',
        'timestamp'
        ];
    }
}
