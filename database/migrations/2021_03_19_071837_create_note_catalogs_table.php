<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     * 章节数据
     * @return void
     */
    public function up()
    {
        Schema::create('note_catalogs', function (Blueprint $table) {
            $table->id();
            $table->integer('note_id')->unsigned()->index('NID')->comment('笔记本ID');
            $table->integer('pid')->unsigned()->default(0)->index('PID')->comment('父级id');
            $table->integer('source_id')->unsigned()->default(0)->index('SID')->comment('源数据');
            $table->string('title')->comment('标题');
            $table->integer('sort')->unsigned()->comment('排序');
            $table->tinyInteger('status')->comment('状态');
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
        Schema::dropIfExists('note_catalogs');
    }
}
