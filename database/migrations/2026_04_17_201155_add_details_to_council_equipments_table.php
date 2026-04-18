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
            $table->string('slug')->unique()->after('name');
            $table->text('task_scope')->nullable()->after('icon_class');
            $table->text('work_partners')->nullable()->after('task_scope');
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