<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->unsignedInteger('movement_id');
            $table->unsignedInteger('withdrawal_type_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('movement_id')->references('id')->on('movements')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('withdrawal_type_id')->references('id')->on('withdrawal_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
}
