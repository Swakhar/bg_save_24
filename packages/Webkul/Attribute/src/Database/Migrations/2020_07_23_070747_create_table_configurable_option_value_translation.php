<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfigurableOptionValueTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurable_option_value_translation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale');
            $table->string('name');
            $table->bigInteger('configurable_option_id');
            $table->foreign('configurable_option_id', 'config_option_id_foreign')
                ->references('id')->on('configurable_option_value')->onDelete('cascade');
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
        Schema::dropIfExists('configurable_option_value_translation');
    }
}
