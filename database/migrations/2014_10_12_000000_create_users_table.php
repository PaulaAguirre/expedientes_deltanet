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
            $table->increments('id');
            $table->string('name');
            $table->string ('lastname');
            $table->string ('cedula');
            $table->string ('mobile')->nullable ();
            $table->string ('phone')->nullable ();
            $table->string('email')->unique();
            $table->integer ('role_id')->default (8);
            $table->string('password')->default (bcrypt ('secret'));
            $table->rememberToken();
            $table->timestamps();
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
