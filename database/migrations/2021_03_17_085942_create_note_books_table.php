<?php

use App\Enums\NoteBook\Defaults;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteBooksTable extends Migration
{
    /**
     * Run the migrations.
     * 笔记本表
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned()->index('UID')->comment("创建者id");

            $table->string("name")->comment("笔记本名称");
            $table->text("desc")->comment("简介");
            $table->string('config')->comment('配置信息');
            $table->string('version')->comment('版本');

            $table->string('cover')->default(Defaults::DEFAULT_COVER)->comment('封面');
            $table->tinyInteger('status')->default(Defaults::DEFAULT_STATUS)->comment('状态');
            $table->tinyInteger("type")->default(Defaults::DEFAULT_TYPE)->comment("类型 1:普通笔记 2:其他笔记 ");

            $table->integer('view_count')->unsigned()->default(0)->comment('阅读数量');
            $table->integer("collect_count")->unsigned()->default(0)->comment("收藏数量");
            $table->integer('fork_count')->unsigned()->default(0)->comment('fork数量');
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
        Schema::dropIfExists('notes');
    }
}
