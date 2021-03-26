<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{

    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('wine_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('wine_id')->references('id')->on('wines');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
