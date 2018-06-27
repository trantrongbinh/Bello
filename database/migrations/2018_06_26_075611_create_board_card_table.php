<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_card', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('board_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('list_id')->unsigned();
            
            $table->foreign('board_id')->references('id')->on('board')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('list_id')->references('id')->on('board_list')->onDelete('cascade');
            
            $table->integer('card_location')->unsigned();
            $table->string('card_title');
            $table->string('card_description');
            $table->string('card_color');
            $table->timestamp('due_date');
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
        Schema::drop('board_card');
    }
}
