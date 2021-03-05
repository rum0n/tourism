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
            $table->bigIncrements('id');
            $table->integer('role_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->boolean('is_approved')->default(1)->nullable();
            $table->string('pro_pic')->default('default.png');
            $table->string('location');
            $table->string('about')->nullable();
            $table->string('motto')->nullable();
            $table->integer('price')->nullable();
            $table->string('activities')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
