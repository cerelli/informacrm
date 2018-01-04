<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->unsignedInteger('user_id')->nullable();

            $table->unsignedInteger('account_id')->nullable();
            $table->unsignedInteger('service_ticket_status_id')->nullable();
            $table->unsignedInteger('service_ticket_result_id')->nullable();

            $table->string('result_description',255)->default('');

            $table->string('created_by', 60)->default('');
            $table->string('updated_by', 60)->default('');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('service_ticket_status_id')->references('id')->on('service_ticket_statuses')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('service_ticket_result_id')->references('id')->on('service_ticket_results')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_tickets');
    }
}
