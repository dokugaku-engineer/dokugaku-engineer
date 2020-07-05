<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturesOldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures_olds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('lesson_id')->unsigned();
            $table->integer('order')->unsigned();
            $table->string('name', 255);
            $table->string('video_url', 255);
            $table->longtext('description');
            $table->string('slug', 255)->nullable();
            $table->string('prev_lecture_slug', 255)->nullable();
            $table->string('next_lecture_slug', 255)->nullable();
            $table->boolean('premium')->default(0);
            $table->softDeletes();
            $table->boolean('existence')->nullable()->storedAs('CASE WHEN deleted_at IS NULL THEN 1 ELSE NULL END');
            $table->timestamps();

            $table->index('course_id');
            $table->index('lesson_id');
            $table->unique(['slug', 'existence']);
            $table->index(['course_id', 'lesson_id', 'order', 'existence']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lectures_olds');
    }
}
