<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id', /*auto increment*/ false, /*unsigned*/ true);
            $table->foreign('question_id')
                ->references('id')->on('questions')
                ->onDelete('cascade');
            $table->integer('answer_id', /*auto increment*/ false, /*unsigned*/ true);
            $table->foreign('answer_id')
                ->references('id')->on('answers')
                ->onDelete('cascade');
            $table->integer('user_id', /*auto increment*/ false, /*unsigned*/ true);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('history');
    }
}
