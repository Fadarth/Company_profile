<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('council_equipments', function (Blueprint $table) {
            $table->integer('rank')->default(0)->after('icon_class');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('council_equipments', function (Blueprint $table) {
            //
        });
    }
};
