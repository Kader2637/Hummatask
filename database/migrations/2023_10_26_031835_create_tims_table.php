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
        
        Schema::create('tims', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('logo')->default('avatar');
            $table->string('nama')->nullable();
            $table->string('repository')->nullable();
            $table->enum('status_tim',['solo','pre_mini','mini','big']);
            $table->boolean('sudah_presentasi')->default(false);
            $table->boolean('kadaluwarsa')->default(false);
            $table->boolean('status_projek')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tims');
    }
};
