<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeCustomizeSectionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_customize_section_details', function (Blueprint $table) {
            $table->integer('display_category_id');
            $table->integer('master_id')->unsigned();
            $table->char('display_block_type', 1)->default('1')->comment('1=subccat, 2 = product');
            $table->foreign('master_id')->references('id')
                ->on('home_customize_section_masters')->onDelete('cascade');
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
        Schema::dropIfExists('home_customize_section_details');
    }
}
