<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMixCustomizeSectionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mix_customize_section_details', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('parent_slug');
            $table->string('title');
            $table->integer('master_section_id')->unsigned();
            $table->foreign('master_section_id')->references('id')
                ->on('mix_customize_section_master')->onDelete('cascade');
            $table->string('slug');
            $table->string('image_url');
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
        Schema::dropIfExists('mix_customize_section_details');
    }
}
