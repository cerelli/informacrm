<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfEventEventClassificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inf_event_event_classification', function (Blueprint $table) {
            $table->integer('event_id')->unsigned();
            $table->integer('event_classification_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->primary(['event_id', 'event_classification_id'], 'event_event_class_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inf_event_event_classification');
    }
}
