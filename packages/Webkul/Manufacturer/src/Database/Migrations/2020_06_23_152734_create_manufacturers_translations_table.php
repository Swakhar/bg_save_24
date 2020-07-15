<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturersTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturers_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale');
            $table->string('name')->nullable();
            $table->bigInteger('manufacturer_id')->unsigned();
            $table->unique(['manufacturer_id','name', 'locale']);
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufacturers_translations');
    }
}
