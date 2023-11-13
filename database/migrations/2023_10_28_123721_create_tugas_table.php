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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tim_id')->constrained();
            $table->string('code');
            $table->string('nama');
            $table->date('deadline')->nullable();
            $table->enum('status_tugas',['tugas_baru','dikerjakan','revisi','selesai'])->default('tugas_baru');
            $table->enum('prioritas',['mendesak','penting','biasa','tambahan','opsional'])->default('biasa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
