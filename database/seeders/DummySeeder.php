<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Data Kategori (berdasarkan gambar/alat telekomunikasi)
        $kategoris = [
            ['kode' => '110', 'nama' => 'ADAPTOR', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => '120', 'nama' => 'ANTENNA', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => '170', 'nama' => 'CABLE', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => '180', 'nama' => 'CCTV', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => '210', 'nama' => 'CONNECTOR', 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('kategoris')->insert($kategoris);

        // 2. Data Satuan
        $satuans = [
            ['kode' => 'PCS', 'nama' => 'Pieces', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'ROLL', 'nama' => 'Roll', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'MTR', 'nama' => 'Meter', 'created_at' => $now, 'updated_at' => $now],
            ['kode' => 'BOX', 'nama' => 'Box', 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('satuans')->insert($satuans);

        // 3. Data Supplier
        $suppliers = [
            ['nama_supplier' => 'PT Telekomindo Makmur', 'no_telp' => '081234567890', 'alamat' => 'Jl. Kebon Sirih No. 10, Jakarta', 'created_at' => $now, 'updated_at' => $now],
            ['nama_supplier' => 'CV Multi Kabel', 'no_telp' => '089876543210', 'alamat' => 'Mangga Dua Square, Jakarta', 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('suppliers')->insert($suppliers);

        // 4. Data Pelanggan
        $pelanggans = [
            ['nama_pelanggan' => 'Site Tower Bekasi 01', 'no_telp' => '085612345678', 'alamat' => 'Jl. Raya Bekasi KM 24', 'created_at' => $now, 'updated_at' => $now],
            ['nama_pelanggan' => 'Site Office Jakarta', 'no_telp' => '087798765432', 'alamat' => 'Gedung Sudirman Lantai 4', 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('pelanggans')->insert($pelanggans);

        // 5. Data Barang
        $barangs = [
            ['nama_barang' => 'Adaptor 12V 2A', 'id_kategori' => 1, 'id_satuan' => 1, 'stok' => 50, 'stok_minimum' => 10, 'created_at' => $now, 'updated_at' => $now],
            ['nama_barang' => 'Antenna Sectoral 5.8 GHz', 'id_kategori' => 2, 'id_satuan' => 1, 'stok' => 4, 'stok_minimum' => 5, 'created_at' => $now, 'updated_at' => $now], // Stok Kritis
            ['nama_barang' => 'Cable Coaxial RG6', 'id_kategori' => 3, 'id_satuan' => 2, 'stok' => 12, 'stok_minimum' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['nama_barang' => 'CCTV Hikvision Indoor 2MP', 'id_kategori' => 4, 'id_satuan' => 1, 'stok' => 25, 'stok_minimum' => 10, 'created_at' => $now, 'updated_at' => $now],
            ['nama_barang' => 'Connector RJ45 Cat6', 'id_kategori' => 5, 'id_satuan' => 4, 'stok' => 2, 'stok_minimum' => 5, 'created_at' => $now, 'updated_at' => $now], // Stok Kritis
            ['nama_barang' => 'Fiber Optic Drop Cable 2 Core', 'id_kategori' => 3, 'id_satuan' => 3, 'stok' => 1500, 'stok_minimum' => 500, 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('barangs')->insert($barangs);
    }
}
