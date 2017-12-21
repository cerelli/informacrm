<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpportunityIdToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inf_events', function($table) {
            $table->unsignedInteger('inf_opportunity_id')->nullable()->after('result_description');

            $table->foreign('inf_opportunity_id')->references('id')->on('inf_opportunities')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inf_events', function($table) {
            $table->dropColumn('inf_opportunity_id');
        });
    }
}
