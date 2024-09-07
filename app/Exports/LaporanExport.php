<?php

namespace App\Exports;

use App\Models\Desa;
use App\Models\Laporan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements WithHeadings, WithMapping, FromView
{

    public function view(): View
    {
        return view('exported.laporan', [
            'laporans' => Laporan::all(),
            'desas'=>Desa::all()
        ]);
    }
    public function map($laporan): array
    {
        return [
            $laporan->id,
            $laporan->institusi,
            $laporan->nama,
            $laporan->desa->nama_desa,
            $laporan->periode,
            $laporan->penyertaan_modal,
            $laporan->omzet,
            $laporan->pendapatan_bersih,
            $laporan->kontribusi_pades
        ];
    }
    public function headings(): array
    {
        return [
            'id',
            'institusi',
            'nama',
            'periode',
            'penyertaan_modal',
            'omzet',
            'pendapatan_bersih',
            'kontribusi_pades'
        ];
    }
}
