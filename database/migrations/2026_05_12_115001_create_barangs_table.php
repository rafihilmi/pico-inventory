<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('sku')->nullable()->unique();
            $table->string('nama_barang');
            $table->foreignId('id_kategori')->nullable()->constrained('kategoris', 'id_kategori')->nullOnDelete();
            $table->foreignId('id_satuan')->nullable()->constrained('satuans', 'id_satuan')->nullOnDelete();
            $table->string('lokasi')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('stok')->default(0);
            $table->integer('stok_minimum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
