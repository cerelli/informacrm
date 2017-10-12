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

    Route::get('search',array('as'=>'search','uses'=>'SearchController@search'));
    Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'SearchController@autocomplete'));
    Route::get('findAccounts','SearchController@findAccounts');
    Route::get('findContacts','SearchController@findContacts');


    Route::get('dashboard', 'DashboardController@index');

    Route::get('events_calendar', 'Inf_eventCrudController@calendar');
    CRUD::resource('title', 'Inf_titleCrudController');
    // your CRUD resources and other admin routes here
    CRUD::resource('account', 'Inf_accountCrudController');
    CRUD::resource('event', 'Inf_eventCrudController');
    CRUD::resource('event_status', 'Inf_event_statusCrudController');
    CRUD::resource('event_result', 'Inf_event_resultCrudController');
    CRUD::resource('event_type', 'Inf_event_typeCrudController');

    CRUD::resource('opportunity', 'Inf_opportunityCrudController');
    CRUD::resource('opportunity_status', 'Inf_opportunity_statusCrudController');
    CRUD::resource('opportunity_result', 'Inf_opportunity_resultCrudController');
    CRUD::resource('opportunity_type', 'Inf_opportunity_typeCrudController');

    //service_ticket
    CRUD::resource('service_ticket', 'Inf_service_ticketCrudController');
    CRUD::resource('service_ticket_status', 'Inf_service_ticket_statusCrudController');
    CRUD::resource('service_ticket_result', 'Inf_service_ticket_resultCrudController');
    CRUD::resource('service_ticket_type', 'Inf_service_ticket_typeCrudController');

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
    CRUD::resource('address_type', 'Inf_address_typeCrudController');

    CRUD::resource('office', 'Inf_officeCrudController');

});
