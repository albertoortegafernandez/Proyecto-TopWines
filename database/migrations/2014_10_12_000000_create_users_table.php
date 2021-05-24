<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('user');
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('nick')->unique();
            $table->string('avatar')->default('userdefault.png');
            $table->string('google_id')->nullable();
            $table->string('adress')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->integer('phone_number')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->brcrypt()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
