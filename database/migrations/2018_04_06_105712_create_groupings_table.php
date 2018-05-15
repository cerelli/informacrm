<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();

            $table->unsignedInteger('grouping_type_id')->nullable();
            $table->unsignedInteger('account_id')->nullable();

            $table->integer('assigned_to')->unsigned()->nullable()->index('assigned_to');

            $table->unsignedInteger('grouping_status_id')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('grouping_type_id')->references('id')->on('grouping_types')->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('assigned_to', 'groupings_user_id_assignedfor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');

            $table->foreign('grouping_status_id')->references('id')->on('grouping_statuses')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('groupings');
    }
}
