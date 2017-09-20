<?php

use Illuminate\Database\Seeder;

class InfContactTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $contactTypes = [
            [
                'description'       => 'Centralino',
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
                'description'       => 'Titolare',
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
                'description'       => 'Dipendente',
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

        DB::table('inf_contact_types')->insert($contactTypes);
    }
}
