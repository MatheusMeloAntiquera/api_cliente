<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Endereco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120)->default(null);
            $table->string('abbreviation', 10)->default(null);
        });

        Schema::create('state', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120)->default(null);
            $table->string('uf', 10)->default(null);
            $table->integer('country')->unsigned();
            $table->foreign('country')
                ->references('id')->on('country')
                ->onDelete('cascade');
        });

        Schema::create('city', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120)->default(null);
            $table->integer('state')->unsigned();
            $table->foreign('state')
                ->references('id')->on('state')
                ->onDelete('cascade');
        });

        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client')->unsigned();
            $table->integer('city')->unsigned();
            $table->string('address', 140)->nullable();
            $table->string('number', 140)->nullable();
            $table->string('complement', 140)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('client')->references('id')->on('client')->onDelete('cascade');
            $table->foreign('city')->references('id')->on('city')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('country');
        Schema::drop('state');
        Schema::drop('city');
        Schema::drop('address');

    }
}
