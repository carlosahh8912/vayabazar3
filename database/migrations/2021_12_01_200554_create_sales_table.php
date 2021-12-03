<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('shipping_id')->constrained();
            $table->foreignId('store_id')->constrained();
            $table->string('shipping_address')->nullable();
            $table->float('total_cost',10,2)->unsigned();
            $table->float('total',10,2)->unsigned();
            $table->boolean('payment_status');
            $table->boolean('shipping_status');
            $table->enum('status',['active', 'cancelled', 'deleted'])->default('active');
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
        Schema::dropIfExists('sales');
    }
}
