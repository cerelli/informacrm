<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.
// Route::get('/api/accounts', 'Api\AccountController@index');
Route::get('/testing/permissions', 'App\Http\Controllers\testing@permissions');

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    
}); // this should be the absolute last line of this file
