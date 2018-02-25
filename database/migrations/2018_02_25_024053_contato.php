<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('contato', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome',140);
            $table->string('telefone',40);
            $table->string('email',120)->nullable();
            $table->integer('cliente')->unsigned();  
            $table->foreign('cliente')->references('id')->on('cliente')->onDelete('cascade');      
            $table->timestamps();
            $table->softDeletes();                                    
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::drop('contato');
        
    }
}
