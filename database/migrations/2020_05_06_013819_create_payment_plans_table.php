<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_plans', function (Blueprint $table) {
            $table->increments('id');
            //Cantidad de días
            $table->integer("frequency");
            $table->integer("daysOfCapitalization");
            $table->integer("termsPerYear");
            $table->integer("totalTerms");
            $table->decimal("tea");
            $table->decimal("tep");
            //Costo oportuniad de capital
            $table->decimal("cokTerms");
            //Costo iniciales Emisor
            $table->float("initialIssuerCosts");
            //Costo iniciales Bonistas
            $table->float("initialBondholderCosts");
            $table->float("actualPrice");
            //Puede ser Utiliad o Perdida... la verdad es solo el REUSLTADO !!!!!!
            $table->float("flowResult");
            $table->float("tceaIssuer");
            $table->float("taxShield");
            $table->float("treaIssuer");
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
        Schema::dropIfExists('payment_plans');
    }
}
