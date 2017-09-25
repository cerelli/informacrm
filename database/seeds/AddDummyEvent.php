<?php

use Illuminate\Database\Seeder;

class AddDummyEvent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ----- inf_event_statuses -------
        $data = [
            [
                'description'       => 'Aperto',
                'color'             => '#ffffff',
                'background_color'  => '#ff003d',
                'icon'              => 'fa-folder-open-o',
                'lft'               => 2,
                'rgt'               => 3,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'In Lavorazione',
                'color'             => '#edf206',
                'background_color'  => '',
                'icon'              => 'fa-truck',
                'lft'               => 4,
                'rgt'               => 5,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'Chiuso',
                'color'             => '#edf206',
                'background_color'  => '',
                'icon'              => 'fa-window-close-o',
                'lft'               => 6,
                'rgt'               => 7,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
        ];
        \DB::table('inf_event_statuses')->insert($data);

        // ----- inf_event_results -------
        $data = [
            [
                'description'       => 'Positivo',
                'color'             => '#ffffff',
                'background_color'  => '#ff003d',
                'icon'              => 'fa-folder-open-o',
                'lft'               => 2,
                'rgt'               => 3,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'Negativo',
                'color'             => '#edf206',
                'background_color'  => '',
                'icon'              => 'fa-truck',
                'lft'               => 4,
                'rgt'               => 5,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
        ];
        \DB::table('inf_event_results')->insert($data);

        // ----- inf_event_classifications -------
        $data = [
            [
                'description'       => 'Nota',
                'color'             => '#ff0707',
                'background_color'  => '#eaff00',
                'icon'              => 'fa-ambulance',
                'lft'               => 2,
                'rgt'               => 3,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'Vendita',
                'color'             => '#408c83',
                'background_color'  => '',
                'icon'              => 'fa-eur',
                'lft'               => 4,
                'rgt'               => 5,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'Assistenza',
                'color'             => '#00f435',
                'background_color'  => '#000000',
                'icon'              => 'fa-gears',
                'lft'               => 6,
                'rgt'               => 7,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'eMail',
                'color'             => '#999999',
                'background_color'  => '',
                'icon'              => 'fa-envelope-o',
                'lft'               => 8,
                'rgt'               => 9,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'Telefonata',
                'color'             => '',
                'background_color'  => '',
                'icon'              => 'fa-phone',
                'lft'               => 10,
                'rgt'               => 11,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'Visita',
                'color'             => '',
                'background_color'  => '',
                'icon'              => 'fa-car',
                'lft'               => 12,
                'rgt'               => 13,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
            [
                'description'       => 'Intervento',
                'color'             => '',
                'background_color'  => '',
                'icon'              => 'fa-ambulance',
                'lft'               => 14,
                'rgt'               => 15,
                'depth'             => 1,
                'created_by'        => 'setup',
                'created_at'        => date('Y-m-d H:i:s')
            ],
        ];
        \DB::table('inf_event_classifications')->insert($data);

        // ----- inf_events -------
        $data = [
         ['title'=>'Finacial forum', 'start_date'=>'2017-10-12', 'end_date'=>'2017-09-15'],
         ['title'=>'Devtalk', 'start_date'=>'2017-10-13', 'end_date'=>'2017-09-25'],
         ['title'=>'Super Event', 'start_date'=>'2017-09-23', 'end_date'=>'2017-09-24'],
         ['title'=>'wtf event', 'start_date'=>'2017-09-19', 'end_date'=>'2017-09-27'],
        ];
        \DB::table('events')->insert($data);


    }
}
