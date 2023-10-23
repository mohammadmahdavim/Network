<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author');
            $table->foreign('author')->on('users')->references('id')->onUpdate('cascade');
            $table->string('name');
            $table->string('family');
            $table->string('mobile')->nullable();
            $table->string('national_code')->nullable();
            $table->integer('emotional')->nullable();
            $table->integer('work')->nullable();
            $table->integer('consult_ability')->nullable();
            $table->integer('success')->nullable();
            $table->integer('intimacy')->nullable();
            $table->integer('age')->nullable();
            $table->integer('motivation')->nullable();
            $table->integer('free_time')->nullable();
            $table->integer('marital_status')->nullable();
            $table->integer('experience')->nullable();
            $table->integer('meets')->nullable();
            $table->string('status')->default('bronze');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
