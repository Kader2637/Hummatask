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
            $table->foreignId('jabatan_id')->references('id')->on('jabatans');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('tim_id')->references('id')->on('tims');
            $table->enum('status', ['active', 'kicked', 'expired']);
            $table->timestamps();
            $table->primary(['user_id','tim_id', 'jabatan_id']);
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
