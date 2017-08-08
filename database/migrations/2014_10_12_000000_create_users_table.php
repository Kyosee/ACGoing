<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname')->default('');
            $table->string('avatar')->default('');
            $table->string('avatar_original')->default('');
            $table->string('mobile')->default('');
            $table->string('email')->unique();
            $table->string('password');
            // $table->char('salt', 5)->default('');
            $table->rememberToken();
            $table->timestamp('activated_at');
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
        Schema::dropIfExists('users');
    }
}
