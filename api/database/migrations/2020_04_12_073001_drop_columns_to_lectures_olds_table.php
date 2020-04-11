<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsToLecturesOldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectures_olds', function (Blueprint $table) {
            $table->dropColumn('public');
            $table->dropColumn('locked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lectures_olds', function (Blueprint $table) {
            $table->boolean('public')->default(1);
            $table->boolean('locked')->default(0);
        });
    }
}
