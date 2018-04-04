<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class testing extends Controller
{
    public function permissions()
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
        // return $permissions;
    }
}
