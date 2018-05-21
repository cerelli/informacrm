<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAcudToGroupings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groupings', function($table) {
            $table->integer('assigned_by')->unsigned()->nullable()->index('assigned_by')->after('assigned_to');
            $table->foreign('assigned_by', 'groupings_user_id_assignedby')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
            $table->datetime('assigned_at')->nullable()->after('assigned_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groupings', function (Blueprint $table) {
            $table->dropForeign('groupings_user_id_assignedby');
            $table->dropIndex('assigned_by');
            $table->dropColumn('assigned_by');
            $table->dropColumn('assigned_at');
        });
    }
}
