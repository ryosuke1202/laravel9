<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50)->nullable(false)->comment('タイトル');
            $table->longText('content')->nullable(false)->comment('本文');
            $table->bigInteger('user_id')->unsigned()->nullable(false)->comment('ユーザーID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('product_id')->unsigned()->nullable(false)->comment('商品ID');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('blogs');
    }
}
