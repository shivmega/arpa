<?php

namespace App\Exports;

use App\Models\Bumdesa;
use App\Models\Desa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BumdesaExport implements WithHeadings, WithMapping, FromView
{

    public function view(): View
    {
        return view('exported.bumdesa', [
            'bumdesas' => Bumdesa::all(),
            'desas' => Desa::all()
        ]);
    }
    public function map($bumdesa): array
    {
        return [
            $bumdesa->id,
            $bumdesa->nama_bumdesa,
            $bumdesa->nama_direktur,
            $bumdesa->aktifitas,
            $bumdesa->tahun_berdiri,
            $bumdesa->desa,
            $bumdesa->status_hukum,
            $bumdesa->kategori,
            $bumdesa->jumlah_pekerja,
            $bumdesa->alamat,
        ];
    }
    public function headings(): array
    {
        return [
            'id',
            'nama_bumdesa',
            'nama_direktur',
            'aktifitas',
            'tahun_berdiri',
            'desa',
            'status_hukum',
            'kategori',
            'jumlah_pekerja',
            'alamat',
            
        ];
    }
}
