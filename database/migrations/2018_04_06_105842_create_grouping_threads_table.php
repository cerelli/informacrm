<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupingThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grouping_threads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grouping_id')->unsigned()->nullable()->index('grouping_id_1');
            $table->string('thread_type',30);

            $table->boolean('is_internal');
            $table->string('title',30)->default('');
            $table->text('description')->default('');

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('grouping_id')->references('id')->on('groupings')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
        // \DB::statement('ALTER TABLE `ticket_thread` MODIFY `body` LONGBLOB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('grouping_threads');
    }
}
