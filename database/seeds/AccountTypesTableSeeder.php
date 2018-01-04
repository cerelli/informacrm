<?php

use Illuminate\Database\Seeder;

class AccountTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $accountTypes = [
            [
                'description'       => 'Cliente Potenziale',
                'color'             => '',
                'background_color'  => '',
                'icon'              => '',
                'lft'               => 2,
                'rgt'               => 3,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'Cliente Attivo',
                'color'             => '',
                'background_color'  => '',
                'icon'              => '',
                'lft'               => 4,
                'rgt'               => 5,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'Rivenditore Attivo',
                'color'             => '',
                'background_color'  => '',
                'icon'              => '',
                'lft'               => 6,
                'rgt'               => 7,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ]
        ];

        DB::table('account_types')->insert($accountTypes);
    }
}
