<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = ['nama_pelanggan', 'alamat', 'no_telp'];

    public function barangKeluar() {
        return $this->hasMany(BarangKeluar::class, 'id_pelanggan', 'id_pelanggan');
    }
}