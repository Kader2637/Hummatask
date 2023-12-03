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
        Schema::create('galeries', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('keterangan')->nullable();
            $table->string('foto');
            $table->enum('status',['album','logo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeries');
    }
};
