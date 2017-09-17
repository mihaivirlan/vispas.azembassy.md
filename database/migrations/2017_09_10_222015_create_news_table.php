<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
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
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
