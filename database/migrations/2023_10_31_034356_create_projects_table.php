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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('code');
            $table->foreignId('tim_id')->references('id')->on('tims');
            $table->foreignId('tema_id')->nullable()->references('id')->on('temas');
            $table->enum('status_project', ['notapproved', 'approved']);
            $table->enum('type_project', ['solo', 'premini', 'mini', 'big']);
            $table->date('deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
