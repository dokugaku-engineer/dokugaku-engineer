<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsOldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_olds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('part_id')->unsigned();
            $table->integer('order')->unsigned();
            $table->string('name', 255);
            $table->timestamps();

            $table->foreign('part_id')->references('id')->on('parts_olds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons_olds');
    }
}
