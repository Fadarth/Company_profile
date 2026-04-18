<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact')->nullable(); // Email atau No HP
            $table->string('category'); // Pendidikan, Kesehatan, Infrastruktur, dll
            $table->text('message'); // Isi aspirasi
            $table->enum('status', ['dalam_proses', 'ditindaklanjuti', 'selesai'])->default('dalam_proses');
            $table->boolean('is_published')->default(false); // Default false agar admin review dulu
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};