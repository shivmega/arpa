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
        Schema::create('bumdesas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bumdesa',50);
            $table->year('tahun_berdiri');
            $table->string('nama_direktrur',100)->nullable();
            $table->string('aktifitas',100);
            $table->foreignId('desa');
            $table->string('status_hukum')->nullable();
            $table->string('kategori')->nullable();
            $table->mediumInteger('jumlah_pekerja')->nullable();
            $table->string('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bumdesas');
    }
};
