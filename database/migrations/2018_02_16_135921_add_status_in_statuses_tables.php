<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusInStatusesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_statuses', function($table) {
            $table->tinyInteger('status')->after('depth');
        });
        Schema::table('opportunity_statuses', function($table) {
            $table->tinyInteger('status')->after('depth');
        });
        Schema::table('service_ticket_statuses', function($table) {
            $table->tinyInteger('status')->after('depth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_statuses', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('opportunity_statuses', function($table) {
            $table->dropColumn('status');
        });
        Schema::table('service_ticket_statuses', function($table) {
            $table->dropColumn('status');
        });
    }
}
