<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('council_equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon_class'); // Menyimpan class icon (misal: 'bx bxs-user-detail')
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('council_equipments');
    }
};