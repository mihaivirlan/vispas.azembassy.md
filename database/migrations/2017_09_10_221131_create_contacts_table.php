<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street_ro');
            $table->string('street_ru');
            $table->string('street_en');
            $table->integer('phone');
            $table->text('fax');
            $table->text('email');
            $table->string('skype');
            $table->string('fb');
            $table->string('twitter');
            $table->string('google');
            $table->string('ok');
            $table->string('wk');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->text('map');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
