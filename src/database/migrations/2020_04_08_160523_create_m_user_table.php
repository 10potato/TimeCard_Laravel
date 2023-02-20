<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_user', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ユーザID'); //(必須)
            $table->string('email')->comment('メールアドレス'); //(必須)
            $table->string('password')->comment('パスワード'); //(必須)
            $table->string('name')->comment('ユーザー名'); //(任意)
            $table->rememberToken(); //(必須)remember_token カラム追加
            $table->timestamps(); //(必須)created_atとupdated_at カラム追加
            $table->softDeletes(); //(任意)deleted_at カラム追加
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_user');
    }
}
