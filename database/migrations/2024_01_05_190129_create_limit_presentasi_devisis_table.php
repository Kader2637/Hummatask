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
        Schema::create('limit_presentasi_devisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tim_id')->nullable()->constrained('tims')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('presentasi_divisi_id')->constrained('presentasi_divisis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->time('mulai');
            $table->time('akhir');
            $table->string('jadwal_ke');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('limit_presentasi_devisis');
    }
};
