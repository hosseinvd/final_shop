<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('cheque_id')->unsigned()->nullable();
            $table->foreign('cheque_id')->references('id')->on('cheques');
            $table->smallInteger('pay_method');//1=cash/2=check/3=pay in location
            $table->smallInteger('state')->default(0);//0=waiting to pay,1=payed
            $table->float('price',10,4);
            $table->smallInteger('refund')->default(0);
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
        Schema::dropIfExists('payments');
    }
}
