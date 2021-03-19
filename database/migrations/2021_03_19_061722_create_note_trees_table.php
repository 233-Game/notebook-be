<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteTreesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     * @see  \App\Enums\NoteTree\Types columns('type')
     */
    public function up()
    {
        Schema::create('note_trees', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->index('UID')->comment('用户id');
            $table->integer('source_id')->unsigned()->default(0)->index('TID')->comment('关联的id');
            $table->integer('pid')->unsigned()->default(0)->index('PID')->comment('父级id');

            $table->string('name')->comment('名称');
            $table->string('path')->comment('路径');
            $table->tinyInteger('type')->unsigned()->comment('类型');

            $table->tinyInteger('level')->unsigned()->default(1)->comment('级别');
            $table->integer('sort')->default(0)->unsigned()->comment('排序');

            $table->tinyInteger('status')->default(\App\Enums\NoteTree\Defaults::DEFAULT_STATUS)->comment('状态');

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
        Schema::dropIfExists('note_trees');
    }
}
