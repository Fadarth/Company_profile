<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('aspirations', function (Blueprint $table) {
            // Menambahkan kolom ip_address setelah message
            $table->string('ip_address')->nullable()->after('message');
        });
    }

    public function down()
    {
        Schema::table('aspirations', function (Blueprint $table) {
            $table->dropColumn('ip_address');
        });
    }
};
