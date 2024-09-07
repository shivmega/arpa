<?php

namespace App\Exports;

use App\Models\Desa;
use App\Models\Umkm;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UmkmExport implements WithHeadings, WithMapping, FromView
{
    
    public function view(): View
    {
        return view('exported.umkm', [
            'umkms'=>Umkm::all(),
            'desas'=>Desa::all()
        ]);
    }
    public function map($umkm): array
    {
        return [
            $umkm->id,
            $umkm->nama_umkm,
            $umkm->tahun_berdiri,
            $umkm->pemilik_umkm,
            $umkm->produk,
            $umkm->foto_produk,
            $umkm->desa->nama_desa,
            $umkm->jangkauan_pasar,
            $umkm->jumlah_pekerja,
            $umkm->omset,
            $umkm->pasar_online,
            $umkm->alamat,
            $umkm->kontak,
            $umkm->keterangan,
            $umkm->timestamp
        ];
    }
    public function headings(): array
    {
        return [
            'id',
            'nama_umkm',
            'pemilik_umkm',
            'tahun_berdiri',
            'produk',
            'foto_produk',
            'desa',
            'jangkauan_pasar',
            'jumlah_pekerja',
            'alamat',
            'kontak',
            'keterangan',
            'time'
        ];
    }
}
