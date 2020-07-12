<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMixCustomizeChildDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mix_customize_child_multi_value', function (Blueprint $table) {
            $table->integer('child_id')->unsigned();
            $table->foreign('child_id')->references('id')
                ->on('mix_customize_section_details_child')->onDelete('cascade');
            $table->integer('multi_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mix_customize_child_multi_value');
    }
}
