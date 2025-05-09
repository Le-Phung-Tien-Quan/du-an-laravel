<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // database/migrations/xxxx_xx_xx_create_order_details_table.php
Schema::create('order_details', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('order_id');
    $table->unsignedBigInteger('product_id');
    $table->integer('quantity');
    $table->decimal('price', 10, 2);
    $table->timestamps();
    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
};
