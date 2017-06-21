<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->integer('movimento_id')->unsigned();
            $table->integer('tipo_credito_id')->unsigned();
            $table->timestamps();

            $table->foreign('movimento_id')->references('id')->on('movimentos');
            $table->foreign('tipo_credito_id')->references('id')->on('tipo_creditos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creditos');
    }
}
