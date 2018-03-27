<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssignedToToActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actions', function($table) {
            $table->integer('assigned_to')->unsigned()->nullable()->index('assigned_to')->after('result_description');
            $table->foreign('assigned_to', 'actions_user_id_assignedfor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actions', function (Blueprint $table) {
            $table->dropForeign('actions_user_id_assignedfor');
            $table->dropIndex('assigned_to');
            $table->dropColumn('assigned_to');
        });
    }
}
