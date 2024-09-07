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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->enum('institusi', ['bumdes', 'umkm']);
            $table->foreignId('id_institusi');
            $table->year('periode');
            $table->decimal('penyertaan_modal', 12,2)->nullable();
            $table->decimal('omzet', 12,2)->nullable();
            $table->decimal('pendapatan_bersih', 12,2)->nullable();
            $table->decimal('kontribusi_pades', 12,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
