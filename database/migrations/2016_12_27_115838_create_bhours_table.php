<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBhoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bhours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('store_id');
            $table->string("mon");
            $table->string("tue");
            $table->string("wed");
            $table->string("thu");
            $table->string("fri");
            $table->string("sat");
            $table->string("sun");
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
        Schema::drop('bhours');
    }
}
