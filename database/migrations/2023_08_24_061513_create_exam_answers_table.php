<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->foreign('exam_id')->on('exams')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('exam_question_id')->nullable();
            $table->foreign('exam_question_id')->on('exam_questions')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('exam_option_id')->nullable();
            $table->foreign('exam_option_id')->on('exam_options')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('correct_option_id')->nullable();
            $table->foreign('correct_option_id')->on('exam_options')->references('id')->onDelete('cascade');
            $table->boolean('true')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_answers');
    }
}
