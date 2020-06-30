<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryIndustriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_industries', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->bigInteger('industry_id')->unsigned();
//            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
//            $table->foreign('industry_id')->references('id')->on('related_industries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_industries');
    }
}
