<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->float('cost',10,2)->unsigned();
            $table->float('price',10,2)->unsigned();
            $table->integer('stock')->unsigned();
            $table->dateTime('purchased');
            $table->string('image')->nullable();
            $table->foreignId('brand_id')->constrained();
            $table->enum('status', ['available', 'unavailable', 'sold', 'removed'])->default('available');
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
        Schema::dropIfExists('products');
    }
}
