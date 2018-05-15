<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcudToActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actions', function($table) {
            $table->integer('assigned_by')->unsigned()->nullable()->index('assigned_by')->after('assigned_to');
            $table->foreign('assigned_by', 'actions_user_id_assignedby')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
            $table->datetime('assigned_at')->nullable()->after('assigned_by');
            $table->integer('deleted_by')->unsigned()->nullable()->after('updated_by');
            $table->foreign('deleted_by', 'actions_user_id_deletedby')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
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
            $table->dropForeign('actions_user_id_assignedby');
            $table->dropForeign('actions_user_id_deletedby');
            $table->dropIndex('assigned_by');
            $table->dropColumn('assigned_by');
            $table->dropColumn('assigned_at');
            $table->dropColumn('deleted_by');
        });
    }
}
