<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfOpportunityInfOpportunityTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inf_opportunity_inf_opportunity_type', function (Blueprint $table) {
            $table->integer('opportunity_id')->unsigned();
            $table->integer('opportunity_type_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->primary(['opportunity_id', 'opportunity_type_id'], 'opportunity_opportunity_type_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inf_opportunity_inf_opportunity_type');
    }
}
