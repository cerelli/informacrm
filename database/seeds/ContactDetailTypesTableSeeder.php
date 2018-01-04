<?php

use Illuminate\Database\Seeder;

class ContactDetailTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $contactDetailTypes = [
            [
                'description'       => 'Casa',
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
                'description'       => 'Ufficio',
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
                'description'       => 'Privato',
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

        DB::table('contact_detail_types')->insert($contactDetailTypes);
    }
}
