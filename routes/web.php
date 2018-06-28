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
Route::get('/api/accounts', 'Api\AccountController@index');
Route::get('/api/actions', 'Api\ActionController@index');
Route::get('/api/groupingtypestatuses/{grouping_id}', 'Api\GroupingController@groupingStatuses');


Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['admin'],
    'namespace' => 'Admin'
], function() {
    // Route::get('test', function () {
    //     return view('test');
    // });
    // CRUD::resource('grouping', 'GroupingCrudController');
    // CRUD::resource('grouping_link', 'Grouping_linkCrudController');
    // Route::get('grouping/list/{grouping_id}', 'GroupingCrudController@list');
    Route::get('downloads/{attachment_id}',function($attachment_id)
    {
        $attachment = App\Models\Attachment::find($attachment_id);
        if (!$attachment) {
        } else {
            $headers = [
            ];
            // dd($attachment);
            return response()->download(storage_path().'/app/'.$attachment->path.'/'.$attachment->fisical_name, $attachment->original_name, $headers);
        }
    });


    CRUD::resource('grouping_type', 'Grouping_typeCrudController');
    CRUD::resource('grouping_status', 'Grouping_statusCrudController');

    CRUD::resource('document_type', 'Document_typeCrudController');
    CRUD::resource('document_status', 'Document_statusCrudController');
    CRUD::resource('document', 'DocumentCrudController');
    Route::group(['prefix' => 'document/{document_id}'], function()
    {
        CRUD::resource('attachment', 'AttachmentCrudController');
        Route::patch('attachment_lock/{attachment_id}','AttachmentCrudController@lock');
        Route::patch('attachment_unlock/{attachment_id}','AttachmentCrudController@unlock');
        // Route::patch('attachment_lock/{attachment_id}/buttons','AttachmentCrudController@buttons');
        // Route::patch('attachment_unlock/{attachment_id}/buttons','AttachmentCrudController@buttons');
    });

    // Route::get('attachment', 'AttachmentCrudController@create');
    // Route::post('/attachment-save', 'AttachmentCrudController@store');
    // Route::post('/attachment-delete', 'AttachmentCrudController@destroy');
    // Route::get('/attachment-show', 'AttachmentCrudController@index');

    //***************grouping*******************
    CRUD::resource('grouping', 'GroupingCrudController');
    Route::get('grouping/{grouping_id}/edit_group', 'GroupingCrudController@edit_group');
    // Route::get('grouping/type/{id}', 'GroupingCrudController@groupingType');
    Route::get('grouping-actions-timeline/{grouping_id}', 'GroupingCrudController@actionsTimeline');
    CRUD::resource('grouping_thread', 'Grouping_threadCrudController');
    Route::get('grouping_internal_note', 'Grouping_threadCrudController@groupingInternalNote');
    Route::patch('/grouping/saveinternalnote/{id}', 'GroupingCrudController@saveInternalNote');
    Route::get('/grouping/internalnote/{id}', 'GroupingCrudController@internalNote');
    /*

    // CRUD::resource('action','ActionCrudController');
    CRUD::resource('action_status', 'Action_statusCrudController');
    CRUD::resource('action_result', 'Action_resultCrudController');
    CRUD::resource('action_type', 'Action_typeCrudController');
    Route::PATCH('/action/assign/{id}', 'ActionCrudController@assign'); /*  Patch Action assigned to whom */
    Route::PATCH('/action/assign/{id}', 'ActionCrudController@assign');
    Route::get('action_acud/{action_id}', 'ActionCrudController@acud');

    // Route::get('search',array('as'=>'search','uses'=>'SearchController@search'));
    // Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'SearchController@autocomplete'));
    Route::get('findAccounts','SearchController@findAccounts');
    Route::get('findContacts','SearchController@findContacts');
    Route::get('findActionsInGrouping','SearchController@findActionsInGrouping');

    Route::get('findSelEventOpportunity','SearchController@findSelEventOpportunity');


    Route::get('dashboard', 'DashboardController@index');

    // Route::get('calendar', 'ActionCalendarCrudController@calendarAction');
    Route::get('getactioneventsjson','ActionCalendarCrudController@getActionEventsJson');

    Route::group(['prefix' => 'calendar'], function()
    {
        Route::get('/', 'ActionCalendarCrudController@calendarAction');
        CRUD::resource('action', 'ActionCalendarCrudController');
    });
    CRUD::resource('title', 'TitleCrudController');
    // your CRUD resources and other admin routes here
    //***************account*******************
    CRUD::resource('account', 'AccountCrudController');
    Route::get('account_tab_actions/{account_id}/{action_status_id?}', 'ActionCrudController@account_tab_actions');
    Route::get('account_tab_documents/{account_id}/{document_status_id?}', 'DocumentCrudController@account_tab_documents');
    Route::get('account_tab_groupings/{account_id}/{grouping_type_id}/{grouping_status_id?}', 'GroupingCrudController@account_tab_groupings');
    Route::get('grouping_tab_actions/{grouping_id}/{action_status_id?}', 'GroupingCrudController@grouping_tab_actions');

    Route::group(['prefix' => 'account/{account_id}'], function()
    {
        CRUD::resource('contact', 'ContactCrudController');
        CRUD::resource('contact/{contact_id}/contact_detail', 'Contact_detailCrudController');
        CRUD::resource('web_site', 'Web_siteCrudController');
        CRUD::resource('address', 'AddressCrudController');
        CRUD::resource('action', 'ActionAccountCrudController');
        CRUD::resource('document', 'DocumentAccountCrudController');
        CRUD::resource('grouping/{grouping_type_id}/grouping', 'GroupingAccountCrudController');
    });


    Route::group(['prefix' => 'grouping/{grouping_id}'], function()
    {
        // CRUD::resource('contact', 'ContactCrudController');
        // CRUD::resource('contact/{contact_id}/contact_detail', 'Contact_detailCrudController');
        // CRUD::resource('web_site', 'Web_siteCrudController');
        // CRUD::resource('address', 'AddressCrudController');
        CRUD::resource('action', 'ActionGroupingCrudController');
        Route::get('action/attach', 'ActionGroupingCrudController@attach');
    });

    CRUD::resource('action', 'ActionCrudController');
    Route::get('action_list', 'ActionCrudController@list');

    // Route::delete('contact_detail/{id}', 'ContactCrudController@destroy');
    CRUD::resource('event', 'EventCrudController');
    Route::get('selevent', 'EventCrudController@select');
    Route::get('selevent/update/{event_id}/{opportunity_id}/{account_id}/{tab}', 'EventCrudController@selectupdate');

    CRUD::resource('event_status', 'Event_statusCrudController');
    CRUD::resource('event_result', 'Event_resultCrudController');
    CRUD::resource('event_type', 'Event_typeCrudController');



    CRUD::resource('opportunity', 'OpportunityCrudController');
    CRUD::resource('opportunity_status', 'Opportunity_statusCrudController');
    CRUD::resource('opportunity_result', 'Opportunity_resultCrudController');
    CRUD::resource('opportunity_type', 'Opportunity_typeCrudController');

    //service_ticket
    CRUD::resource('service_ticket', 'Service_ticketCrudController');
    CRUD::resource('service_ticket_status', 'Service_ticket_statusCrudController');
    CRUD::resource('service_ticket_result', 'Service_ticket_resultCrudController');
    CRUD::resource('service_ticket_type', 'Service_ticket_typeCrudController');

    // Route::get('terminate',['middleware' => 'account','uses' => 'AccountCrudController@index',]);

    CRUD::resource('account_type', 'Account_typeCrudController');


    CRUD::resource('contact_type', 'Contact_typeCrudController');

    CRUD::resource('contact_detail_type', 'Contact_detail_typeCrudController');
    CRUD::resource('communication_type', 'Communication_typeCrudController');


    CRUD::resource('web_site_type', 'Web_site_typeCrudController');


    CRUD::resource('address_type', 'Address_typeCrudController');

    CRUD::resource('office', 'OfficeCrudController');

});
