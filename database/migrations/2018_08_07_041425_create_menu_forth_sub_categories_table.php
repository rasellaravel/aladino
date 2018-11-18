<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuForthSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_forth_sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('tri_sub_category_id');
            $table->string('forth_sub_category_name');
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
        Schema::dropIfExists('menu_forth_sub_categories');
    }
}
