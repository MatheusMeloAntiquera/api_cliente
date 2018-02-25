<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Endereco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('pais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',120)->default(NULL);
            $table->string('sigla',10)->default(NULL);
            //
        });

        Schema::create('estado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',120)->default(NULL);
            $table->string('uf',10)->default(NULL);
            $table->integer('pais')->unsigned();
            $table->foreign('pais')
             ->references('id')->on('pais')
             ->onDelete('cascade');
            //
        });

        Schema::create('cidade', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',120)->default(NULL);
            $table->integer('estado')->unsigned();
            $table->foreign('estado')
             ->references('id')->on('estado')
             ->onDelete('cascade');
            //
        });        

        Schema::create('endereco', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente')->unsigned();
            $table->integer('cidade')->unsigned();       
            $table->string('logradouro',140)->nullable();
            $table->string('numero',140)->nullable();
            $table->string('complemento',140)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cliente')->references('id')->on('cliente')->onDelete('cascade');
            $table->foreign('cidade')->references('id')->on('cidade')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pais');
        Schema::drop('estado');
        Schema::drop('cidade');
        Schema::drop('endereco');
        
    }
}
