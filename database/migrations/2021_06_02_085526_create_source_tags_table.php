<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourceTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('source_tags', function (Blueprint $table) {
            $table->unsignedInteger('tag_id')->comment('tag_id');
            $table->unsignedInteger('source_id')->comment('source');
            $table->primary(['tag_id','source_id']);
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
        Schema::dropIfExists('source_tags');
    }
}
