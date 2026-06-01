<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers'; 
    protected $primaryKey = 'id_supplier';
    protected $fillable = ['nama_supplier', 'alamat', 'no_telp'];

    public function barangMasuk() {
        return $this->hasMany(BarangMasuk::class, 'id_supplier', 'id_supplier');
    }
}