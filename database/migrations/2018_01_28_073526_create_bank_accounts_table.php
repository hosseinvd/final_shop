<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->float('money',12,4)->default(0);
            //person who get the money
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('payer_id')->unsigned()->index();
            $table->foreign('payer_id')->references('id')->on('users');
            $table->integer('pay_to_id')->unsigned()->index();
            $table->foreign('pay_to_id')->references('id')->on('users');
            $table->integer('basket_id')->unsigned();
            $table->smallInteger('type')->default(0);//type={user_order_with his code=1 , direct charge=2 , receive from reseller=3 , pay to seller=4, credit_buy=4}
            $table->smallInteger('commission_paid')->default(0);
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
        Schema::dropIfExists('bank_accounts');
    }
}
