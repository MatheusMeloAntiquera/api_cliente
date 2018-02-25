<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',140);     
            $table->string('telefone',40);
            $table->string('celular',40);
            $table->timestamps();
            $table->softDeletes();
         });
        
    }

    /**
     * Reverse the migrations  .
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('cliente');
    }
}
