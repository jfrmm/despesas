<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->unsignedInteger('movement_id');
            $table->unsignedInteger('deposit_type_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('movement_id')->references('id')->on('movements')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('deposit_type_id')->references('id')->on('deposit_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}
