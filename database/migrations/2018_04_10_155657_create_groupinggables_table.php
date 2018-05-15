<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupinggablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupinggables', function (Blueprint $table) {
            $table->unsignedInteger('grouping_id')->nullable();
            $table->string('description',60)->default('');
            $table->morphs('groupinggable');
            $table->timestamps();

            $table->foreign('grouping_id')->references('id')->on('groupings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groupinggables');
    }
}
