<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 30)->unique()->nullable(false)->comment('商品名');
            $table->integer('price')->length(7)->nullable(false)->comment('単価');
            $table->string('image')->nullable(false)->comment('商品画像');
            $table->text('description')->nullable(false)->comment('説明');
            $table->bigInteger('tag_id')->unsigned()->nullable(false)->comment('製品タグ');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->integer('stock')->length(4)->default(0)->nullable(false)->comment('在庫個数');
            $table->bigInteger('type_id')->unsigned()->nullable(false)->comment('製品タイプ');
            $table->foreign('type_id')->references('id')->on('types');
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
        Schema::dropIfExists('products');
    }
}
