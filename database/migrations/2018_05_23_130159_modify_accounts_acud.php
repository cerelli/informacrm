<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Account;
use App\User;

class ModifyAccountsAcud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function($table) {
            $table->renameColumn('created_by', 'created_by_old');
            $table->renameColumn('updated_by', 'updated_by_old');
        });
        Schema::table('accounts', function($table) {
            $table->integer('created_by')->unsigned()->nullable()->after('updated_by_old');
            $table->integer('updated_by')->unsigned()->nullable()->after('created_by');
            $table->integer('deleted_by')->unsigned()->nullable()->after('updated_by');

            $table->foreign('created_by', 'accounts_user_id_createfor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
            $table->foreign('updated_by', 'accounts_user_id_updatefor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
            $table->foreign('deleted_by', 'accounts_user_id_deletefor')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('RESTRICT');
        });
        $accounts = Account::all();
        foreach ($accounts as $account) {
            $user = User::where('name', $account->created_by_old)->first();
            if ( $user['id'] <= 0 ) {
                $account->created_by = null;
            } else {
                $account->created_by = $user['id'];
            }
            $user = User::where('name', $account->updated_by_old)->first();
            if ( $user['id'] <= 0 ) {
                $account->updated_by = null;
            } else {
                $account->updated_by = $user['id'];
            }
            $account->save();
        }
        Schema::table('accounts', function($table) {
            if(Schema::hasColumn('accounts', 'created_by_old'))
            {
                $table->dropColumn('created_by_old');
            }
            if(Schema::hasColumn('accounts', 'updated_by_old'))
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
