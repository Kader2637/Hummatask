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
        Schema::create('aktifitas_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aktifitas_id')->references('id')->on('aktifitas')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('label_id')->nullable()->references('id')->on('labels')->onDelete('cascade');
            $table->enum("status",['penugasan','label']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktifitas_data');
    }
};
