<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name', 10)->comment('ユーザー名');
            $table->integer('sex')->unsigned()->nullable(false)->comment('性別');
            $table->string('email', 50)->unique()->nullable(false)->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable()->comment('アドレス確認用');
            $table->string('phone')->nullable(false)->comment('電話番号');
            $table->integer('status')->unsigned()->nullable(false)->comment('ステータス');
            $table->string('zip_code', 8)->nullable(false)->comment('郵便番号');
            $table->string('prefecture', 4)->nullable(false)->comment('都道府県');
            $table->string('city', 55)->nullable(false)->comment('市区町村');
            $table->string('building', 55)->nullable(false)->comment('建物名');
            $table->string('password', 100)->nullable()->comment('パスワード');
            $table->bigInteger('role_id')->length(1)->unsigned()->nullable(false)->comment('権限');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->rememberToken()->comment('再設定用トークン');
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
