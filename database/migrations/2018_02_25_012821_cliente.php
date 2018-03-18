<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 140);
            $table->string('telephone', 40);
            $table->string('cellphone', 40);
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
        Schema::drop('customer');
    }
}
