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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_umkm',50);
            $table->year('tahun_berdiri');
            $table->string('produk', 100);
            $table->string('foto_produk')->nullable();
            $table->foreignId('desa')->constrained();
            $table->string('jangkauan_pasar', 200)->nullable();
            $table->mediumInteger('jumlah_pekerja')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kontak',15)->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
