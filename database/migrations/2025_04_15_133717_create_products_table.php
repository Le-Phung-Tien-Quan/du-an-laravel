<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->float('rating')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->unsignedBigInteger('category_id');  // Ensure the category_id is unsigned
  // Khóa ngoại trỏ đến `categories`
            $table->string('image');
            $table->integer('views')->default(0);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Khóa ngoại với bảng `categories`
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
