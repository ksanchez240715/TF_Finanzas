<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("typeOfCurrency");
            // El valor que tiene para la  empresa
            $table->float("nominalValue");
            // El valor que tiene en el mercado
            $table->float("commercialValue");
            $table->integer("year");
            $table->integer("paymentFrequency");
            $table->integer("exact");
            $table->integer("capitalization");
            $table->integer("interestRate");
            $table->integer("annualDiscountRate");
            $table->date("dateOfIssue");
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonds');
    }
}
