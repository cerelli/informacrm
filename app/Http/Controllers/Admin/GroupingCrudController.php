<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\Groupings\Grouping;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\GroupingRequest as StoreRequest;
use App\Http\Requests\GroupingRequest as UpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Groupings\Grouping_thread;
use Auth;

class GroupingCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Groupings\Grouping');

        // $grouping_type_id = \Route::current()->parameter('grouping_type_id');
        // set a different route for the admin panel buttons
        // $this->crud->setRoute("admin/account/".$account_id."#actions");
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/grouping');
        // $this->crud->cancelRoute = ("admin/account/".$account_id."#actions");


        $this->crud->setEntityNameStrings(trans('informacrm.grouping'), trans('informacrm.groupings'));
        $this->crud->setShowView('inf.grouping.show');
        $this->crud->setListView('inf.grouping.list');
        // $this->crud->enableReorder('name', 1);
        // $this->crud->allowAccess('reorder');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();
        $this->crud->setBoxOptions('basic', [
            'side' => false,         // Place this box on the right side?
            'class' => "box-default",  // CSS class to add to the div. Eg, <div class="box box-info">
            'collapsible' => false,
            'viewNameBox' => false,
            'collapsed' => false,    // Collapse this box by default?
        ]);


        $this->crud->setBoxOptions('assignments', [
            'side' => true,         // Place this box on the right side?
            'class' => "box-info",  // CSS class to add to the div. Eg, <div class="box box-info">
            'collapsible' => false,
            'viewNameBox' => false,
            'collapsed' => false,    // Collapse this box by default?
        ]);

        // $action_id = \Route::current()->parameter('action');
        // if ( $action_id > 0 ) {
            if ( Auth::user()->hasPermissionTo('change the action account') ) {
                // dump('pippo');
                $disabled = '';
            }else{
                // dump('pluto');/
                $disabled = 'disabled';
            };
        // } else {
        //     $disabled = '';
        // }

        // $this->crud->addField([
        //     'name' => 'thread',
        //     'label' => 'thread',
        //     'type' => 'ckeditor',
        //     'tab'      => 'General',
        //     'class' => 'hidden'
        // ]);

        $this->crud->addField([
            'name' => 'account_id',
            'label' => trans('general.account'),
            'type' => 'select2_from_ajax',
            'entity' => 'account', // the method that defines the relationship in your Model
            'attribute' => 'full_name', // foreign key attribute that is shown to user
            'model' => "App\Models\Account", // foreign key model
            'data_source' => url("api/accounts"),
            'placeholder' => trans('general.account'),
            'minimum_input_length' => 2,
            'box' => 'basic',
            'attributes' => [$disabled => $disabled],
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12'
            ],
            'tab'      => 'General',
        ]);



        $this->crud->addField([
            'label' => trans('general.type'),
            'type' => 'select2',
            'name' => 'grouping_type_id', // the db column for the foreign key
            'entity' => 'grouping_type', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Groupings\Grouping_type",
            'box' => 'basic',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6 required'
            ],
            'tab'      => 'General',
        ]);

        $this->crud->addField([
            'label' => trans('general.status'),
            'type' => 'select',
            'name' => 'grouping_status_id', // the db column for the foreign key
            'entity' => 'grouping_status', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Groupings\Grouping_status", // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6 required'
            ],
            'box' => 'basic',
            'tab'      => 'General',
        ]);

        $this->crud->addField([
            'name' => 'title',
            'label' => trans('general.title'),
            'type' => 'text',
            'box' => 'basic',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12 required'
            ],
            'tab'      => 'General',
        ]);

        $this->crud->addField([   // WYSIWYG Editor
            'name' => 'description',
            'label' => trans('general.description'),
            'box' => 'basic',
            'type' => 'ckeditor',
            'tab'      => 'General',
        ]);

        // $this->crud->addField([   // WYSIWYG Editor
        //     'name' => 'custom-ajax-button',
        //     'type' => 'view',
        //     'view' => 'test',
        //     'box' => 'basic',
        //     'tab'      => 'Actions',
        // ]);

        // $this->crud->addField(
        //     [   'name' => 'custom-search',
        //         'type' => 'view',
        //         'view' => 'inf.search.actions_in_grouping',
        //         'box'  => 'basic',
        //         'tab'  => 'Actions',
        //         'wrapperAttributes' => [
        //             'class' => 'form-group col-md-6'
        //         ],
        //     ]
        // );


        // $this->crud->addField(
        //     [   // CustomHTML
        //         'name' => 'separator',
        //         'type' => 'custom_html',
        //         'value' => '<a class="btn btn-default btn-sm" id="click1" data-dati="'.url(config("backpack.base.route_prefix", "admin")). '/grouping-actions-timeline"><i class="fa fa-refresh"></i></a>',
        //         'box'  => 'basic',
        //         'tab'  => 'Actions',
        //         'wrapperAttributes' => [
        //             'class' => 'form-group col-md-6'
        //         ],
        //     ]
        // );

        // $data['actions'] = GroupingCrudController::actionsTimeline();
        // $this->crud->addField(
        //     [   'name' => 'actions66',
        //         'type' => 'view',
        //         'view' => 'inf.grouping.actions_timeline',
        //         'box'  => 'basic',
        //         'tab'  => 'Actions',
        //     ], 'update'
        // );

        // $this->crud->addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning');
        $this->crud->addField([
            'label' => trans('general.assignment'),
            'type' => 'select2',
            'name' => 'assigned_to', // the db column for the foreign key
            'entity' => 'user_assigned_to', // the method that defines the relationship in your Model
            'attribute' => 'name',
            'box' => 'assignments',
            'model' => "App\User"
        ]);

        //********************************TEST********************************************
        // $this->crud->addField([
        //     'label' => 'Actions2',
        //     'type' => 'morph_select2_multiple',
        //     "morph" => true,
        //     'name' => 'actions',
        //     'entity' => 'grouppinggabble',
        //     'attribute' => 'title',
        //     'model' => 'App\Models\Action',
        //     'pivot' => true,
        //     'box' => 'basic',
        //     'tab'      => 'Actions',
        // ]);

        $this->crud->addField([
                    // n-n relationship
                    'label' => "Actions2", // Table column heading
                    'type' => "select2_from_ajax_multiple",
                    'name' => 'actions', // the column that contains the ID of that connected entity
                    'entity' => 'actions', // the method that defines the relationship in your Model
                    'attribute' => "description", // foreign key attribute that is shown to user
                    'model' => "App\Models\Action", // foreign key model
                    'data_source' => url("api/actions"), // url to controller search function (with /{id} should return model)
                    'placeholder' => "Select an action", // placeholder for the select
                    'minimum_input_length' => 2, // minimum characters to type before querying results
                    'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                    'morph' => true,
                    'box' => 'basic',
                    'tab'      => 'Actions',
         ]);

        // $this->crud->child_resource_included = ['select' => true, 'number' => true];
        //
        // $this->crud->addField([// Table
        //     'name' => 'actions',
        //     'label' => 'Actions',
        //     'type' => 'table_morph',
        //     'entity_singular' => 'action', // used on the "Add X" button
        //     'columns' => [
        //         'id' => 'Name',
        //         'description' => 'Description',
        //         'title' => 'Price'
        //     ],
        //     'max' => 5, // maximum rows allowed in the table
        //     'min' => 0, // minimum rows allowed in the table
        //     'pivot' => true,
        //     'morph' => true,
        // ]);

        // $this->crud->child_resource_included = ['select' => false, 'number' => false];
        //
        // $this->crud->addField([
        //             'name' => 'actions',
        //             'label' => 'Exercícios',
        //             'type' => 'child',
        //             'entity_singular' => 'action', // used on the "Add X" button
        //             'columns' => [
        //                 ['label' => 'Exercício',
        //                     'type' => 'child_select',
        //                     'name' => 'id',
        //                     'entity' => 'id',
        //                     'attribute' => 'description',
        //                     'size' => '3',
        //                     'model' => "App\Models\Action"],
        //
        //             ],
        //             'max' => 12, // maximum rows allowed in the table
        //             'min' => 0 // minimum rows allowed in the table
        //         ]);
        //********************************TEST********************************************
        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        $this->crud->addColumn(
            [
                'name' => 'id', // The db column name
                'label' => trans('general.id'), // Table column heading
                // 'prefix' => "Name: ",
                // 'suffix' => "(user)",
                // 'limit' => 120, // character limit; default is 50;
            ]);

        $this->crud->addColumn([
            // run a function on the CRUD model and show its return value
            'name' => "titlelink",
            'label' => trans('informacrm.title'), // Table column heading
            'type' => "model_function",
            'function_name' => 'getShowTitleLink', // the method in your Model
            'limit' => 120,
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere('title', 'like', '%'.$searchTerm.'%');
            },
            // 'orderable' => true
        ]);



        // $grouping_type_id = \Route::current()->parameter('id');
        // $this->crud->addClause('where','grouping_type_id', '=', $grouping_type_id);

        // $this->crud->orderBy('lft');
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);
        // $this->crud->setColumnDetails('id_tipo_cliente',
        // ['label' => "Tipo Cliente",
        // 'type' => "select",
        // 'name' => 'id_tipo_cliente',
        // 'entity' => 'tipo_cliente',
        // 'attribute' => "descrizione",
        // 'model' => App\Models\TipoCliente]
        // );
        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        $this->crud->allowAccess(['show','list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php
        $this->crud->enableDetailsRow();
        $this->crud->allowAccess('details_row');
        $this->crud->setDetailsRowView('inf.details_row.grouping');

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES


        // $this->crud->addClause('type', 'car');
        $grouping_type_id = $this->crud->request->get('grouping_type_id');
        if ( isset($grouping_type_id) ) {
            $this->crud->addClause('ofType', $grouping_type_id);
        } else {

        }

        // $this->crud->grouping_type_id = $this->crud->request->get('grouping_type_id');

        // dump($this->crud);
        // dump($this->crud);
        // $this->crud->addClause('whereGrouping_type_id', $grouping_type_id);
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });

        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
        // dump(\Route::current()->parameter('grouping_type_id'));
    }

    public function destroy($parent_id, $id = null)
    {
        $result = parent::destroy($id);
        return $result;
    }

    public function edit($parent_id, $id = null)
    {
        $result = parent::edit($id);
        $this->crud->cancelRoute = (config('backpack.base.route_prefix') . '/grouping?grouping_type_id='.$parent_id);
        return $result;
    }

    public function edit_group($parent_id, $id = null)
    {

        $result = parent::edit($id);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/grouping');
        $this->crud->cancelRoute = (config('backpack.base.route_prefix') . '/grouping/'.$parent_id);
        return $result;

    }

    public function create()
    {
        $this->crud->create_fields['assigned_to']['value'] = Auth::user()->id;
        // $account_id = \Route::current()->parameter('account_id');
        // if ( !$account_id ) {
        //
        // } else {
        //     $this->crud->create_fields['account_id']['value'] = $account_id;
        // }

        return parent::create();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        if ( $request['assigned_to'] <= 0) {
            $request['assigned_to'] = Auth::user()->id;
            $request['assigned_at'] = date('Y-m-d H:i:s');
        }
        if ( !isset($request['assigned_at']) ) {
            $request['assigned_at'] = date('Y-m-d H:i:s');
        }
        if ( $request['assigned_by'] <= 0) {
            $request['assigned_by'] = Auth::user()->id;
        }

        // dd($this->crud);
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        // dump($request['account_id']);
        // $action_id = \Route::current()->parameter('action');
        $saveAction = $this->getSaveAction()['active']['value'];

        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/grouping/create');
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/grouping/'.$this->crud->entry->id);
                break;
        }
        // dd($this->crud->entry->id);
        //***************************ORIGINAL********
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        if ( $request['assigned_to'] <= 0) {
            $request['assigned_to'] = Auth::user()->id;
            $request['assigned_at'] = date('Y-m-d H:i:s');
        }
        if ( !isset($request['assigned_at']) ) {
            $request['assigned_at'] = date('Y-m-d H:i:s');
        }
        if ( $request['assigned_by'] <= 0) {
            $request['assigned_by'] = Auth::user()->id;
        }
        $redirect_location = parent::updateCrud($request);
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/grouping/create');
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/grouping/'.$this->crud->entry->id);
                break;
        }
        //***************************ORIGINAL********
        return $redirect_location;
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function actionsTimeline($grouping_id)
    {
        // $actions = grouping::with('actions')->get();
        // dump($actions);
        // return $actions;
        // return $grouping->actions();
        // // $this->data['timelines'] = GroupingCrudController::actionsTimeline();
        // $grouping_id = \Route::current()->parameter('id');
        $grouping = grouping::find($grouping_id);

        return view('inf.grouping.actions_timeline_details',['actions' => $grouping->actions]);
        // if($this->request->ajax()) {
        //     $grouping = grouping::find($this->entry)->get();
        //     // $entry->actions = $grouping->actions;
        //     // $data['timelines'] = 'pippo';/
        //     // dump($grouping->actions);
        //     return view('inf.grouping.actions_timeline_details',$grouping->actions);
        //     // return view('admin.users',$users)->renderSections()['content'];
        // }
        // $timelines = DB::table('actions')->get();
        // // dump($this->data['timelines']);
        // dump($timelines);
        // return $timelines;
    }

    public function grouping_tab_actions($grouping_id, $action_status_id = null)
    {
        $grouping = grouping::with('actions.action_status')->find($grouping_id);
        $data['actions'] = $grouping->actions;
        $data['grouping'] = $grouping;
        // $data['actionStatuses'] = $grouping->actions->pluck('action_status')->unique();

        // $data['countActionStatuses'] = $grouping->actions->pluck('action_status')->groupBy('description');
        $data['actionStatuses'] = $grouping->actions->pluck('action_status')->groupBy('description')->map(function ($countActionStatus) {
            $elaboration['count'] = $countActionStatus->count();
            $elaboration['attributes'] = $countActionStatus[0];
            return $elaboration;
        });
        // dd($data['actionStatuses']);
        // $data['actionStatuses'] = $grouping->actions->pluck('action_status')->mapToGroups(function ($item, $key) {
        //     return [$item['description'] => $item];
        //     // return $countActionStatus->count();
        // });
        // foreach ($data['actionStatuses'] as $test) {
        //     dump($test->count());
        // }
        // dd($data['actionStatuses']['']);
        // foreach ($grouping->actions as $key => $value) {
        //     $data['countActionStatuses'][$key] = $value;
        //
        // }
        // // dd($data['actions']);
        // $data['countActionTypes'] ='';
        // // $data['countActionStatuses'] = Action_status::countActions($account_id)->get();
        // // $data['countActionTypes'] = Action_type::countActions($account_id)->get();
        //
        // $data['active_account_id']['id'] = $account_id;
        // // $filter = new CrudFilter($options, $values, $filter_logic);
        // // $data['filter']['name'] = 'filtro1';
        // dd($action_status_id);
        if (!$action_status_id){
            //active first action_status
            // $data['actions']->where('action_status_id', '=', $data['countActionStatuses'][0]->id);
// dd($action_status_id);
            if ( $action_status_id == '0' ) {
                $viewReturn = 'inf.grouping.actions_timeline_details';
            } else {
                $viewReturn = 'inf.grouping.actions_timeline';
            }
        }else{
            $data['actions'] = $data['actions']->where('action_status_id', '=', $action_status_id);
            $viewReturn = 'inf.grouping.actions_timeline_details';
        }
        // $data['actions'] = $data['actions']->get();
        return view($viewReturn, $data);
    }

    public function show($id)
    {
        $this->crud->hasAccessOrFail('show');
        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;

        // set columns from db
        $this->crud->setFromDb();
        // cycle through columns
        foreach ($this->crud->columns as $key => $column) {
            // remove any autoset relationship columns
            if (array_key_exists('model', $column) && array_key_exists('autoset', $column) && $column['autoset']) {
                $this->crud->removeColumn($column['name']);
            }
        }
        // get the info for that entry
        // $this->data['entry'] = $this->crud->getEntry($id);

        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['title'] = trans('backpack::crud.preview').' '.$this->crud->entity_name;
        $this->data['acud'] = Grouping::find($id)->acud;

        // remove preview button from stack:line
        $this->crud->removeButton('preview');
        $this->crud->removeButton('delete');
        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getShowView(), $this->data);
    }

    public function InternalNote($id)
    {

        $threads = Grouping_thread::where('grouping_id', '=', $id)->orderby('created_at','DESC')->get();
        // dd($threads);
        return view('inf.grouping.thread_timeline',['threads' => $threads]);
    }

    public function SaveInternalNote($id)
    {

        $InternalContent = Input::get('content');
        $NewThread = new Grouping_thread();
        $NewThread->grouping_id = $id;
        $NewThread->description = $InternalContent;
        $NewThread->thread_type = 'internal_note';
        $NewThread->is_internal = 1;
        $NewThread->created_by = Auth::user()->id;
        $NewThread->save();
        $data = [
            'grouping_id' => $id,
            'u_id'      => Auth::user()->first_name.' '.Auth::user()->last_name,
            'body'      => $InternalContent,
        ];
        $result = $this->internalNote($id);
        return $result;
        // //$thread = Ticket_Thread::where('ticket_id', '=', $id)->first();
        // $NewThread = new Ticket_Thread();
        // $NewThread->ticket_id = $id;
        // $NewThread->user_id = Auth::user()->id;
        // $NewThread->is_internal = 1;
        // $NewThread->thread_type = 'note';
        // $NewThread->poster = Auth::user()->role;
        // //$NewThread->title = $thread->title;
        // $NewThread->body = $InternalContent;
        // $NewThread->save();
        // $data = [
        //     'ticket_id' => $id,
        //     'u_id'      => Auth::user()->first_name.' '.Auth::user()->last_name,
        //     'body'      => $InternalContent,
        // ];
        // \Event::fire('Reply-Ticket', [$data]);
        //
        // return 1;
    }

}
