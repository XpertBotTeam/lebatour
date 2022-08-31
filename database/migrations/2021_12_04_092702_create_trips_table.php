<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('thumbnail')->unique();
            $table->string('title');
            $table->string('description');
            $table->string('priceperperson');
            $table->String('Days');
            $table->String('time');
            $table->string('adminDistrict');
            $table->string('city');
            $table->boolean('hold')->default(false);
            $table->string('postalcode')->nullable();
            $table->string('adressline')->nullable();
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
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
        Schema::dropIfExists('trips');
    }
}
