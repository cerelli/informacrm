<?php

use Illuminate\Database\Seeder;

class AddressTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $addressTypes = [
            [
                'description'       => 'Sede Legale',
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
                'description'       => 'Sede Unica',
                'color'             => '',
                'background_color'  => '',
                'icon'              => '',
                'lft'               => 4,
                'rgt'               => 5,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ]
        ];

        DB::table('address_types')->insert($addressTypes);
    }
}
