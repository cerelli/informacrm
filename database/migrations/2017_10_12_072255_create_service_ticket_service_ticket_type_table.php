<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTicketServiceTicketTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_ticket_service_ticket_type', function (Blueprint $table) {
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
        Schema::dropIfExists('service_ticket_service_ticket_type');
    }
}
