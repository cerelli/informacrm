<?php

use Illuminate\Database\Seeder;

class AddFirstRolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ----- roles -------
        $data = [
            ['name'       => 'root', 'created_at'  => date('Y-m-d H:i:s')],
            ['name'       => 'admin',       'created_at'  => date('Y-m-d H:i:s')],
            ['name'       => 'user',        'created_at'  => date('Y-m-d H:i:s')],
        ];
        \DB::table('roles')->insert($data);

        // ----- permissions -------
        $data = [
            ['name'       => 'list', 'created_at'        => date('Y-m-d H:i:s')],
            ['name'       => 'create', 'created_at'        => date('Y-m-d H:i:s')],
            ['name'       => 'update', 'created_at'        => date('Y-m-d H:i:s')],
            ['name'       => 'reorder', 'created_at'        => date('Y-m-d H:i:s')],
            ['name'       => 'delete', 'created_at'        => date('Y-m-d H:i:s')],
            ['name'       => 'read', 'created_at'        => date('Y-m-d H:i:s')],
            ['name'       => 'show admin menu', 'created_at'        => date('Y-m-d H:i:s')],
            ['name'       => 'show config menu', 'created_at'        => date('Y-m-d H:i:s')],
            ['name'       => 'show user menu', 'created_at'        => date('Y-m-d H:i:s')],
        ];
        \DB::table('permissions')->insert($data);


    }
}
