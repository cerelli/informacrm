<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // Event::listen('revisionable.created', function($model, $revisions) {
        //     // Do something with the revisions or the changed model.
        //     if ( $revisions[0]['revisionable_type'] == 'actions' ) {
        //         $revpass[0] = $revisions[0];
        //         $revpass[0]['key'] = 'assigned_to';
        //         $revpass[0]['new_value'] = $model->assigned_to;
        //
        //         // array_push($revisions, $revpass[0]);
        //         DB::table('revisions')->insert($revpass);
        //
        //     } else {
        //
        //     }
        //
        //     // dd($model, $revisions, $model->assigned_to);
        // });

    }
}
