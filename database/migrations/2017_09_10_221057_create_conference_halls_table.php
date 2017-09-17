<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConferenceHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conference_halls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_ro');
            $table->string('title_ru');
            $table->string('title_en');
            $table->string('meta_description_ro');
            $table->string('meta_description_en');
            $table->string('meta_description_ru');
            $table->string('slug_ro');
            $table->string('slug_ru');
            $table->string('slug_en');
            $table->string('mini_description_ro');
            $table->string('mini_description_ru');
            $table->string('mini_description_en');
            $table->text('description_ro');
            $table->text('description_ru');
            $table->text('description_en');
            $table->integer('status');
            $table->string('service_ro');
            $table->string('service_ru');
            $table->string('service_en');
            $table->text('image_1');
            $table->text('image_2');
            $table->text('image_3');
            $table->text('image_4');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conference_halls');
    }
}
