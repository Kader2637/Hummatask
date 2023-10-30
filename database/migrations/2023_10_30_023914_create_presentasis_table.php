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
        Schema::create('presentasis', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('judul');
            $table->text('deskripsi');
            $table->date('jadwal');
            $table->enum('status_pengajuan',['menunggu','disetujui','ditolak'])->default('menunggu');
            $table->enum('status_presentasi',['menunggu','selesai','telat'])->default('menunggu');
            $table->text('feedback')->nullable();
            $table->foreignId('tim_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentasis');
    }
};
