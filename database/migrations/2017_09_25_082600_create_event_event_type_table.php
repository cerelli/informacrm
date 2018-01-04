<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventEventTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_event_type', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('event_type_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->primary(['event_id', 'event_type_id'], 'event_event_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_event_type');
    }
}
