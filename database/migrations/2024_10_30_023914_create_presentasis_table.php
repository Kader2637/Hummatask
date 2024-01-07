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
            $table->integer('urutan')->nullable();
            $table->date('jadwal');
            $table->enum('status_pengajuan',['menunggu','disetujui','ditolak'])->default('menunggu');
            $table->enum('status_presentasi',['menunggu','selesai','telat'])->default('menunggu');
            $table->boolean('status_presentasi_mingguan')->default(false);
            $table->text('feedback')->nullable();
            $table->enum('status_revisi',['selesai','tidak_selesai'])->nullable();
            $table->foreignId('tim_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('history_presentasi_id')->references('id')->on('history_presentasis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_approval_id')->nullable()->references('id')->on('users');
            $table->foreignId('limit_presentasi_devisi_id')->references('id')->on('limit_presentasi_devisis')->cascadeOnDelete()->cascadeOnUpdate();
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
