<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsQuery extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('operations_query', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('x1')->unsigned();
            $table->integer('y1')->unsigned();
            $table->integer('z1')->unsigned();
            $table->integer('x2')->unsigned();
            $table->integer('y2')->unsigned();
            $table->integer('z2')->unsigned();

            $table->integer('result')->unsigned()->nullable();

            $table->integer('cube_id')->unsigned();
            $table->foreign('cube_id')->references('id')->on('cubes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('operations_query');
    }
}
