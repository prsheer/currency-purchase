<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->decimal('amount_usd', 10, 2);
            $table->decimal('total', 10, 2);
            $table->decimal('surchange', 10, 2);
            $table->decimal('discount_amount', 10, 2);
            $table->string('discount_percentage');
            $table->decimal('grand_total', 10, 2);
            $table->string('currency_purshased');
            $table->string('surchange_percentage');
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
        Schema::dropIfExists('orders');
    }
}
