<?php

use Illuminate\Database\Seeder;

class WebSiteTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $webSiteTypes = [
            [
                'description'       => 'Principale',
                'color'             => '',
                'background_color'  => '',
                'icon'              => '',
                'lft'               => 2,
                'rgt'               => 3,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ]
        ];

        DB::table('web_site_types')->insert($webSiteTypes);
    }
}
