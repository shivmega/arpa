<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Laporan extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
        'id',
        'institusi',
        'nama',
        'desa',
        'periode',
        'penyertaan_modal', 
        'omzet',
        'pendapatan_bersih',
        'kontribusi_pades',
    ];
    protected $primarykey = 'id';
    public function toSearchableArray()
    {
        return [
            'institusi' => $this->institusi,
            'periode'=> $this->periode,
            'nama'=>$this->nama,
            'desa'=>$this->desa
        ];
    }
}
