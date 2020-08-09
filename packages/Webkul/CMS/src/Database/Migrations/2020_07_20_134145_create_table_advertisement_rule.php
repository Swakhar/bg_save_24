<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAdvertisementRule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_rule', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('master_id')->unsigned();
            $table->foreign('master_id')->references('id')
                ->on('advertisement_master')->onDelete('cascade');
            $table->string('label');
            $table->string('operation');
            $table->string('rule_value');
            $table->string('is_multi')->comment("1 = true, 0 = false");
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
        Schema::dropIfExists('advertisement_rule');
    }
}
