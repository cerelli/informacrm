<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupingStatusGroupingTypePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grouping_status_grouping_type', function (Blueprint $table) {
            $table->integer('grouping_status_id')->unsigned()->index();
            $table->foreign('grouping_status_id', 'gr_statuses_gr_status_id')->references('id')->on('grouping_statuses')->onDelete('cascade');
            $table->integer('grouping_type_id')->unsigned()->index();
            $table->foreign('grouping_type_id','gr_types_gr_type_id')->references('id')->on('grouping_types')->onDelete('cascade');
            $table->primary(['grouping_status_id', 'grouping_type_id'], 'gr_status_id_gr_type_id_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grouping_status_grouping_type');
    }
}
