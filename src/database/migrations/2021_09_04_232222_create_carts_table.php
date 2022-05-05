<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->unsigned()->nullable(false)->comment('製品情報');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('quantity')->nullable()->comment('購入量');
            $table->bigInteger('user_id')->unsigned()->nullable(false)->comment('ユーザー名');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('order_number', 255)->nullable(false)->comment('注文番号');
            $table->bigInteger('type_id')->unsigned()->nullable(false)->comment('タイプ');
            $table->foreign('type_id')->references('id')->on('types');
            $table->bigInteger('status_id')->unsigned()->nullable(false)->comment('ステータス');
            $table->foreign('status_id')->references('id')->on('statuses');
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
        Schema::dropIfExists('carts');
    }
}
