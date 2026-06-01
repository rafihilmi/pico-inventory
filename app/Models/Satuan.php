<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'satuans';
    protected $primaryKey = 'id_satuan';

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_satuan', 'id_satuan');
    }
}
