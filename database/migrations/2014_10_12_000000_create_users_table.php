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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('avatar')->nullable();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('divisi_id')->nullable()->references('id')->on('divisis')->onDelete('set null')->onUpdate('set null');
            $table->boolean('status')->default(true);
            $table->string('tlp')->nullable();
            $table->string('sekolah')->nullable();
            $table->date('tanggal_bergabung')->nullable();
            $table->date('tanggal_lulus')->nullable();
            $table->boolean('status_kelulusan')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_login')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
