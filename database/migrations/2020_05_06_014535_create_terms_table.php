<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("number");
            $table->date("paymentDate");
            $table->decimal("annualInflation");
            $table->decimal("termInflation");
            // T | S | P
            $table->char("gracePeriod");
            $table->float("bondValue");
            $table->float("bondValueIndex");
            $table->float("coupon");
            $table->float("total");
            $table->float("amortization");
            $table->float("prima");
            $table->float("taxShield");
            $table->float("emitterFlow");
            $table->float("emitterFlowShield");
            $table->float("IssuerFlow");
            $table->integer('payment_plan_id')->unsigned();
            $table->foreign('payment_plan_id')->references('id')->on('payment_plans');
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
        Schema::dropIfExists('terms');
    }
}
