<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfigurableOptionValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurable_option_value', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admin_name');
            $table->text('description');
            $table->tinyInteger('published');
            $table->integer('dis_order');
            $table->decimal('discounts');
            $table->string('image');
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
        Schema::dropIfExists('configurable_option_value');
    }
}
