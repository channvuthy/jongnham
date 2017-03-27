<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_name');
            $table->string('phone');
            $table->string('website');
            $table->string('images');
            $table->string('address');
            $table->string('description');
            $table->time('open');
            $table->time('close');
            $table->integer('status');
            $table->integer('store_type');
            $table->integer('typeoffood_id');
            $table->integer('typeofplace_id');
            $table->string('email');
            $table->string('maplat');
            $table->string('maplon');
            $table->time('pricefrom');
            $table->time('priceto');
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
        Schema::drop('stores');
    }
}
