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
        Schema::create('pengajuan_presentasis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('limit_presentasi_devisi_id')->constrained('limit_presentasi_devisis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_presentasis');
    }
};
