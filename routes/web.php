<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth'], 'namespace' => 'Admin'], function () {
    // Backpack\MenuCRUD
    CRUD::resource('menu-item', 'MenuItemCrudController');
});

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['admin'],
    'namespace' => 'Admin'
], function() {

    Route::get('dashboard', 'DashboardController@index');

    Route::get('events', 'EventCrudController@index');

    // your CRUD resources and other admin routes here
    CRUD::resource('account', 'Inf_accountCrudController');
    // Route::get('terminate',['middleware' => 'account','uses' => 'Inf_accountCrudController@index',]);

    CRUD::resource('account_type', 'Inf_account_typeCrudController');

    CRUD::resource('contact', 'Inf_contactCrudController');
    CRUD::resource('contact_type', 'Inf_contact_typeCrudController');
    CRUD::resource('contact_detail', 'Inf_contact_detailCrudController');
    CRUD::resource('contact_detail_type', 'Inf_contact_detail_typeCrudController');
    CRUD::resource('communication_type', 'Inf_communication_typeCrudController');

    CRUD::resource('web_site', 'Inf_web_siteCrudController');
    CRUD::resource('web_site_type', 'Inf_web_site_typeCrudController');

    CRUD::resource('address', 'Inf_addressCrudController');
});
