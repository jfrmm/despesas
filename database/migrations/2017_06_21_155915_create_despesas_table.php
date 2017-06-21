<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->integer('movimento_id')->unsigned();
            $table->integer('tipo_despesa_id')->unsigned();
            $table->timestamps();

            $table->foreign('movimento_id')->references('id')->on('movimentos');
            $table->foreign('tipo_despesa_id')->references('id')->on('tipo_despesas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despesas');
    }
}
