<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('lecture_id')->unsigned();
            $table->timestamps();

            // course_idとlecture_idに外部キーを貼るとoldsテーブルを参照しているときに整合性がとれなくなることがあるため貼らない
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'course_id']);
            $table->unique(['user_id', 'lecture_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learning_histories');
    }
}
