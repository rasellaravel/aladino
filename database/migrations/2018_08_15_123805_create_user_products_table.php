<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('shop_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->integer('tri_sub_category_id')->nullable();
            $table->string('product_title')->nullable();
            $table->string('price')->nullable();
            $table->string('reviews')->nullable();
            $table->integer('order')->nullable();
            $table->string('size')->nullable();
            $table->string('return_polichy')->nullable();
            $table->text('description')->nullable();
            $table->string('who_made_it')->nullable();
            $table->text('what_is_it')->nullable();
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
        Schema::dropIfExists('user_products');
    }
}
