<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     * 多对多 -> tree 根据source 对应 文件/git/note/content/
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->index('UID')->comment('用户id');
            $table->string('title')->comment('标题');
            $table->tinyInteger('type')->default(1)->comment('类型 1：属于笔记本 2:属于直接笔记本');
            $table->longText('content')->nullable()->comment('内容 json格式,确保数据的一致性');
            $table->integer('size')->unsigned()->default(0)->comment('大小');
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
        Schema::dropIfExists('sources');
    }
}
