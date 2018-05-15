<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \Carbon\Carbon::setLocale(config('app.locale'));
        // \Carbon\Carbon::setLocale(LC_TIME, 'it_IT.UTF8');
        setlocale(LC_TIME, 'it_IT.UTF8');
        \Carbon\Carbon::setLocale(config('app.locale'));
        Schema::defaultStringLength(191);

        Relation::morphMap([
            'actions' => 'App\Models\Action',
        ]);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
