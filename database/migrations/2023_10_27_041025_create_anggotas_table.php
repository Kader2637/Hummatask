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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->enum('jabatan',['anggota','ketua_tim','ketua_project']);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('tim_id')->references('id')->on('tims');
            $table->timestamps();
            $table->primary(['user_id','tim_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
