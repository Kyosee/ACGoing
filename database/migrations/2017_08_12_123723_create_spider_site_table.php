<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpiderSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spider_site', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_type_id');
            $table->string('site_name')->default('');
            $table->string('site_url')->default('');
            $table->string('base_filter')->default('');
            $table->string('info_filter')->default('');
            $table->integer('status')->default(1);          //是否启用 0 未启用 1启用
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spider_site');
    }
}
