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
            $table->float('deposit',12,4)->default(0);
            $table->float('due',12,4)->default(0);
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('payer_id')->unsigned()->index();
            $table->foreign('payer_id')->references('id')->on('users');
            $table->integer('basket_id')->unsigned();
            $table->smallInteger('type')->default(1);//type={user_order=1 - charge=2 -reseller=3 - credit_buy=4}
            $table->boolean('commission_paid')->default('false');
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
