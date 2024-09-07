<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Umkm extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
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
        'omset',
        'pasar_online',
        'keterangan',
        'kontak'
    ];
    protected $primarykey = 'id';
    public function toSearchableArray()
    {
        return [
            'nama_umkm' => $this->nama_umkm,
            'tahun_berdiri'=> $this->tahun_berdiri,
            'produk'=> $this->produk,
            'desa'=>$this->desa
        ];
    }
}
