<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('notes')->nullable();

            $table->boolean('all_day')->default(0);
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();

            $table->unsignedInteger('account_id')->nullable();
            $table->unsignedInteger('event_status_id')->nullable();
            $table->unsignedInteger('event_result_id')->nullable();

            $table->string('result_description',255)->default('');

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('event_status_id')->references('id')->on('event_statuses')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('event_result_id')->references('id')->on('event_results')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
