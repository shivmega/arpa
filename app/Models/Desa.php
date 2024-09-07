<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;



class Desa extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
        'id',
        'nama_desa',
        'nama_kades',
        'nama_sekdes',
        'nama_perangkat_desa',
        'kecamatan',
        'kabupaten',
        'jumlah_penduduk',
        'alamat',
        'keterangan'
    ];
    protected $primarykey = 'id';

    public function toSearchableArray()
    {
        return [
            'nama_desa' => $this->nama_desa,
            'nama_kades'=> $this->nama_kades,
            'kecamatan'=>$this->kecamatan
        ];
    }
    
}
