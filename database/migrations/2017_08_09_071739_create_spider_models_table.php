<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpiderModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spider', function (Blueprint $table) {
            $table->increments('id');
            $table->string('spider_name')->default('');
            $table->string('spider_url')->default('');
            $table->string('fillter_title')->default('');
            $table->string('fillter_description')->default('');
            $table->string('fillter_author')->default('');
            $table->string('fillter_time')->default('');
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
        Schema::dropIfExists('spider_models');
    }
}
