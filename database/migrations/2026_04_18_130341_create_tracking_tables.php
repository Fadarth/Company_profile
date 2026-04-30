<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Tabel untuk tracking akses website harian
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->date('visit_date');
            $table->timestamps();
        });

        // 2. Tabel untuk riwayat klik berita (untuk rule jeda 1 jam)
        Schema::create('news_views', function (Blueprint $table) {
            $table->id();
            // Pastikan foreign key sesuai dengan nama tabel berita Anda
            $table->foreignId('news_id')->constrained('news')->cascadeOnDelete();
            $table->string('ip_address');
            $table->timestamps();
        });

        // 3. Tambah kolom total view di tabel news utama
        Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('views_count')->default(0)->after('description');
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_views');
        Schema::dropIfExists('visitors');
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('views_count');
        });
    }
};