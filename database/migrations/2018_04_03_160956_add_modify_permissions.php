<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddModifyPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'list',
            'create',
            'update',
            'reorder',
            'delete',
            'read',
            'show admin menu',
            'show config menu',
            'show user menu',
            'create account',
            'update account',
            'delete account',
            'show actions of all users',
            'change the action account'
        ];
        foreach ($permissions as $permission) {
            $permission_id = DB::table('permissions')->where('name', $permission)->value('id');
            if ( !$permission_id ) {
                $data = [['name' => $permission, 'created_at'=> date('Y-m-d H:i:s')],
                ];
                \DB::table('permissions')->insert($data);
            } else {
                // dump($permission_id);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
