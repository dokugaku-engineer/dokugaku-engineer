<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lesson_id')->unsigned();
            $table->integer('order')->unsigned();
            $table->string('name', 255);
            $table->string('video_url', 255);
            $table->longtext('description');
            $table->string('slug', 255)->unique();
            $table->string('prev_lecture_slug', 255);
            $table->string('next_lecture_slug', 255);
            $table->boolean('locked')->default(0);
            $table->boolean('premium')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lectures');
    }
}
