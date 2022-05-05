<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable(false)->comment('問い合わせ者');
            $table->string('phone' )->nullable(false)->comment('電話番号');
            $table->string('email', 50)->nullable(false)->comment('メールアドレス');
            $table->text('content')->nullable(false)->comment('問い合わせ内容');
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
        Schema::dropIfExists('inquiries');
    }
}
