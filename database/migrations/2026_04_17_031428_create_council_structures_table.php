<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('council_structures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('file_path')->nullable(); // Untuk menyimpan path file PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('council_structures');
    }
};