<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMixCustomizeSectionMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mix_customize_section_master', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('subtitle');
            $table->string('slug');
            $table->string('admin_url');
            $table->char('is_visible', 1)->comment('1 = visible 0 = invisible');
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
        Schema::dropIfExists('mix_customize_section_master');
    }
}
