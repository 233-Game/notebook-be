<?php

use App\Enums\User\Defaults;
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
            $table->id();
            $table->string('name')->comment('名称');
            $table->string('avatar')->default(Defaults::AVATAR)->comment('头像');
            $table->string('phone')->nullable()->comment('手机号');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('password')->nullable()->comment('密码');
            $table->tinyInteger('sex')->default(3)->comment('性别');
            $table->tinyInteger('status')->default(1)->comment('状态');

            $table->string('remember_token')->nullable()->comment('');
            $table->string('config')->nullable()->comment('各种配置信息');
            $table->timestamp('email_verified_at')->nullable()->comment('邮箱认证');
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
