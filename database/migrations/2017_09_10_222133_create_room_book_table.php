<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_book', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->integer('id_room');
            $table->integer('status');
            $table->integer('phone');
            $table->text('comment');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_book');
    }
}
