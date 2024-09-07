<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Bumdesa extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
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
    protected $primarykey = 'id';
    public function toSearchableArray()
    {
        return [
            'nama_bumdesa' => $this->nama_bumdesa,
            'tahun_berdiri'=> $this->tahun_berdiri,
            'nama_direktur'=> $this->nama_direktur,
            'aktifitas'=>$this->aktifitas,
        ];
    }
    public function desa(): BelongsTo{
        return $this->belongsTo(Desa::class, 'desa', 'id');
    }
}
