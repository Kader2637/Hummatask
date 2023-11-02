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
        Schema::create('ajukanpresentasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tim_id')->references('id')->on('tims');
            $table->string('judul');
            $table->string('deskripsi');
            $table->date('jadwal');
            $table->enum('status_presentasi',['menunggu','selesai'])->nullable();
            $table->enum('status_pengajuan', ['ditolak','menunggu','disetujui'])->nullable();
            $table->string('feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajukanpresentasis');
    }
};
