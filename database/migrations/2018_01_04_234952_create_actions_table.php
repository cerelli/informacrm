<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('notes')->nullable();

            $table->boolean('all_day')->default(0);
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();

            $table->unsignedInteger('account_id')->nullable();
            $table->unsignedInteger('action_status_id')->nullable();
            $table->unsignedInteger('action_result_id')->nullable();

            $table->string('result_description',255)->nullable()->default('');

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('action_status_id')->references('id')->on('action_statuses')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('action_result_id')->references('id')->on('action_results')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
