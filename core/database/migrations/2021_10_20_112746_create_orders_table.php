<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('user_id');
            $table->integer('product_id');
            $table->tinyInteger('delivery_area')->comment('1 = inside city, 2 = outside city');
            $table->tinyInteger('payment_type')->comment('1 = direct, 2 = cash on delivery');
            $table->decimal('total_amount',18,8);
            $table->tinyInteger('status')->comment('0 = pending, 1 = completed, 2 = processing, 3 = returned');
            $table->tinyInteger('pay_status')->comment('0 = pending, 1 = paid');
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
