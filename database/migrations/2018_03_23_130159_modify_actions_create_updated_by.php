<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Action;
use App\User;

class ModifyActionsCreateUpdatedBy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actions', function($table) {
            $table->renameColumn('created_by', 'created_by_old');
            $table->renameColumn('updated_by', 'updated_by_old');
        });
        Schema::table('actions', function($table) {
            $table->integer('created_by')->unsigned()->nullable()->after('updated_by_old');
            $table->integer('updated_by')->unsigned()->nullable()->after('created_by');

            $table->foreign('created_by', 'actions_user_id_createfor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
            $table->foreign('updated_by', 'actions_user_id_updatefor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
        });
        $actions = Action::all();
        foreach ($actions as $action) {
            $user = User::where('name', $action->created_by_old)->first();
            if ( $user['id'] <= 0 ) {
                $action->created_by = null;
            } else {
                $action->created_by = $user['id'];
            }
            $user = User::where('name', $action->updated_by_old)->first();
            if ( $user['id'] <= 0 ) {
                $action->updated_by = null;
            } else {
                $action->updated_by = $user['id'];
            }
            $action->save();
        }
        Schema::table('actions', function($table) {
            if(Schema::hasColumn('actions', 'created_by_old'))
            {
                $table->dropColumn('created_by_old');
            }
            if(Schema::hasColumn('actions', 'updated_by_old'))
            {
                $table->dropColumn('updated_by_old');
            }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
