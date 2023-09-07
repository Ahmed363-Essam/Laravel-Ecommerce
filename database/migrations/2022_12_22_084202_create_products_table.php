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

            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');

            $table->unsignedBigInteger('cat_id')->nullable();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');

            $table->string('name')->required();

            $table->string('slug')->unique()->nullable();

            $table->text('description')->nullable();

            $table->string('image')->nullable();

            $table->float('price')->default(0);

            $table->float('compare_price')->default(0);

            $table->json('options')->nullable();

            $table->float('rating')->default(0);

            $table->boolean('featured')->default(0);

            $table->enum('status',['active','draft','archived'])->default('active');

            $table->softDeletes();



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
