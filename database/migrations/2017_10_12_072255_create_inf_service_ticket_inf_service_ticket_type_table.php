<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfServiceTicketInfServiceTicketTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inf_service_ticket_inf_service_ticket_type', function (Blueprint $table) {
            $table->integer('service_ticket_id')->unsigned();
            $table->integer('service_ticket_type_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->primary(['service_ticket_id', 'service_ticket_type_id'], 'service_ticket_service_ticket_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inf_service_ticket_inf_service_ticket_type');
    }
}
