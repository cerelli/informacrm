<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\DB;
use App\Models\Action;
use App\Models\Action_status;
use App\Models\Action_type;
use App\User;
use Auth;


// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ActionRequest as StoreRequest;
use App\Http\Requests\ActionRequest as UpdateRequest;

class ActionCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Action');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/action');
        $this->crud->setEntityNameStrings(trans('informacrm.action'), trans('informacrm.actions'));
        // $this->crud->setListView('inf.action');
        // $this->crud->setEditView('inf.edit');
        // dump($this->crud);
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();

        // $this->crud->addFilter([ // select2_multiple filter
        //     'name' => 'action',
        //     'type' => 'select2_multiple',
        //     'label'=> trans('informacrm.account_types')
        // ], function() { // the options that show up in the select2
        //     return [
        //     1 => 'In stock',
        //     2 => 'In provider stock',
        //     3 => 'Available upon ordering',
        //     4 => 'Not available',
        //     ];
        // }, function($value) { // if the filter is active
        //     $this->crud->addClause('where', 'status', $value);
        // });
        // ------ CRUD FIELDS
        $this->crud->setBoxOptions('basic', [
            'side' => false,         // Place this box on the right side?
            'class' => "box-default",  // CSS class to add to the div. Eg, <div class="box box-info">
            'collapsible' => false,
            'viewNameBox' => false,
            'collapsed' => false,    // Collapse this box by default?
        ]);

        $this->crud->setBoxOptions('schedule', [
            'side' => true,         // Place this box on the right side?
            'class' => "box-info",  // CSS class to add to the div. Eg, <div class="box box-info">
            'collapsible' => false,
            'collapsed' => false,    // Collapse this box by default?
        ]);

        $this->crud->setBoxOptions('result', [
            'side' => false,         // Place this box on the right side?
            'class' => "box-info",  // CSS class to add to the div. Eg, <div class="box box-info">
            'collapsible' => true,
            'collapsed' => false,    // Collapse this box by default?
        ]);


        $this->crud->setBoxOptions('assignments', [
            'side' => true,         // Place this box on the right side?
            'class' => "box-info",  // CSS class to add to the div. Eg, <div class="box box-info">
            'collapsible' => true,
            'collapsed' => false,    // Collapse this box by default?
        ]);

        $this->crud->addField([
            'name' => 'account_id',
            'label' => trans('informacrm.account_id'),
            'type' => 'hidden',
            'box' => 'basic'
        ]);

        $this->crud->addField([
            'name' => 'title',
            'label' => trans('informacrm.action_title').' *',
            'type' => 'text',
            'box' => 'basic'
        ]);

        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => trans('informacrm.action_types').' *',
                'type' => 'select2_multiple',
                'name' => 'action_types', // the method that defines the relationship in your Model
                'entity' => 'action_types', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Action_type", // foreign key model
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-9'
                ],
                'box' => 'basic'
            ]);

            $this->crud->addField([
                'label' => trans('informacrm.action_status').' *',
                'type' => 'select',
                'name' => 'action_status_id', // the db column for the foreign key
                'entity' => 'action_status', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Action_status", // foreign key model
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3'
                ],
                'box' => 'basic'
            ]);

            $this->crud->addField([   // WYSIWYG Editor
                'name' => 'notes',
                'label' => trans('informacrm.action_notes'),
                'type' => 'ckeditor',
                'box' => 'basic'
            ]);

            // $this->crud->addField([   // CustomHTML
            //     'name' => 'separator',
            //     'type' => 'custom_html',
            //     'value' => '',
            //     'wrapperAttributes' => [
            //         'class' => 'row',
            //         'style' => 'margin-top: 20px'
            //     ]
            // ]);


            // $this->crud->addField(
            //     [
            //         'label' => trans('informacrm.action_in_calendar'),
            //         'name' => 'in_calendar',
            //         'type' => 'toggle',
            //         'inline' => true,
            //         'options' => [
            //             0 => 'No',
            //             1 => 'Si'
            //         ],
            //         'hide_when' => [
            //             0 => ['all_day', 'start_date', 'end_date'],
            //         ],
            //         'default' => 0,
            //         'wrapperAttributes' => [
            //             'class' => 'form-group col-md-12'
            //         ]
            // ]);


            $this->crud->addField(
                [
                    'label' => trans('informacrm.schedule'),
                    'name' => 'all_day',
                    'type' => 'toggle',
                    'inline' => true,
                    'options' => [
                        -1 => 'No',
                        0 => 'Si',
                        1 => 'Tutto il giorno'
                    ],
                    'hide_when' => [
                        -1 => ['start_date', 'end_date'],
                        1 => ['end_date'],
                    ],
                    'default' => -1,
                    'wrapperAttributes' => [
                        'class' => 'form-group col-md-12'
                    ],
                    'box' => 'schedule'
            ]);

            // $this->crud->addField([   // Checkbox
            //     'name' => 'all_day',
            //     'label' => trans('informacrm.action_all_day'),
            //     'type' => 'checkbox',
            //     'default' => 0,
            //     'wrapperAttributes' => [
            //         'class' => 'form-group col-md-12'
            //     ]
            // ]);


            // $this->crud->addField([   // CustomHTML
            //     'name' => 'separator1',
            //     'type' => 'custom_html',
            //     'value' => '',
            //     'wrapperAttributes' => [
            //         'class' => 'row',
            //         'style' => 'margin-top: 20px'
            //     ]
            // ]);
            $this->crud->addField([   // DateTime
                'name' => 'start_date',
                'label' => trans('informacrm.action_start'),
                'type' => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'it'
                ],
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6'
                ],
                'box' => 'schedule'
            ]);

            $this->crud->addField([   // DateTime
                'name' => 'end_date',
                'label' => trans('informacrm.action_end'),
                'type' => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'it'
                ],
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6'
                ],
                'box' => 'schedule'
            ]);

            $this->crud->addField([
                'label' => trans('informacrm.assignments'),
                'type' => 'select',
                'name' => 'assigned_to', // the db column for the foreign key
                'entity' => 'user_assigned_to', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\User", // foreign key model
                'box' => 'assignments'
            ]);

            $this->crud->addField([
                'label' => trans('informacrm.action_result_id'),
                'type' => 'select',
                'name' => 'action_result_id', // the db column for the foreign key
                'entity' => 'action_result', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Action_result", // foreign key model
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-12'
                ],
                'box' => 'result'
            ]);


            $this->crud->addField([   // WYSIWYG Editor
                'name' => 'result_description',
                'label' => trans('informacrm.action_result_description'),
                'type' => 'ckeditor',
                'box' => 'result'
            ]);

            $this->crud->addFilter([ // select2_multiple filter
              'name' => 'status',
              'type' => 'select2_multiple',
              'label'=> trans('general.statuses')
            ], function() {
                    $statuses = Action_status::all();
                    $statusList = [];
                    $statuses->each(function ($s) use (&$statusList) {
                        $statusList[$s->id] = $s->description;
                    });
                    return $statusList;
            }, function($values) { // if the filter is active
                if (isset($values)) {
                    foreach (json_decode($values) as $key => $value) {
                        $this->crud->addClause('orwhere', 'action_status_id', $value);
                        // if ($key == 0) {
                        //     $this->crud->addClause('where', 'action_status_id', $value);
                        // } else {
                        //     $this->crud->addClause('orWhere', 'action_status_id', $value);
                        // }
                    }
                }
            });


            if ( Auth::user()->hasPermissionTo('show actions of all users') ) {
                $this->crud->addClause('withoutGlobalScopes');
                $this->crud->addFilter([ // select2_multiple filter
                    'name' => 'users',
                    'type' => 'select2',
                    'label'=> trans('general.users')
                ], function() { // the options that show up in the select2
                    return User::all()->pluck('name', 'id')->toArray();
                }, function($value) { // if the filter is active
                    $this->crud->addClause('where', 'assigned_to', $value);
                });
            }

            $this->crud->addFilter([ // select2_multiple filter
                'name' => 'action_types',
                'type' => 'select2_multiple',
                'label'=> trans('general.types')
            ], function() { // the options that show up in the select2
                return Action_type::all()->pluck('description', 'id')->toArray();
            }, function($values) { // if the filter is active
                foreach (json_decode($values) as $key => $value) {
                    // if ( $value <> '') {
                        $this->crud->query = $this->crud->query->whereHas('action_types', function ($query) use ($value) {
                            $query->Where('action_type_id', $value);
                        });
                        // if ($key == 1) {
                        //     $this->crud->query = $this->crud->query->whereHas('action_types', function ($query) use ($value) {
                        //         $query->Where('action_type_id', $value);
                        //     });
                        // } else {
                        //     $this->crud->query = $this->crud->query->whereHas('action_types', function ($query) use ($value) {
                        //         $query->orWhere('action_type_iad', $value);
                        //     });
                        // }
                    // }


                }
            });

            // dump($this->crud);

            // $this->crud->addFilter([ // dropdown filter
            //   'name' => 'actions',
            //   'type' => 'dropdown',
            //   'label'=> 'Azioni...'
            // ], [
            //   1 => 'Create da me',
            //   2 => 'Assegnate a me',
            // ], function($value) { // if the filter is active
            //     switch ( $value ) {
            //         case 1:
            //             $this->crud->addClause('where', 'created_by', Auth::user()->id);
            //             break;
            //         case 2:
            //             $this->crud->addClause('where', 'assigned_to', Auth::user()->id);
            //             break;
            //         default:
            //             break;
            //     }
            // });

            $this->crud->addColumn([
                'name' => 'id', // The db column name
                'label' => trans('general.id'), // Table column heading
                'type' => "model_function",
                'function_name' => 'getShowIdLink', // the method in your Model
            ]);

            $this->crud->addColumn([
                'name' => "account",
                'label' => trans('informacrm.account'), // Table column heading
                'type' => "model_function",
                'function_name' => 'getShowAccountLink',
                'limit' => 120,
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhereHas('account', function ($q) use ($column, $searchTerm) {
                        $q->where('name1', 'like', '%'.$searchTerm.'%')
                        ->orWhere('name2', 'like', '%'.$searchTerm.'%');
                    });
                }
            ]);

            $this->crud->addColumn([
                // run a function on the CRUD model and show its return value
                'name' => 'title',
                'label' => trans('general.title')
            ]);

            $this->crud->addColumn([
                // n-n relationship (with pivot table)
                'label' => trans('general.statuses'), // Table column heading
                'type' => 'label',
                'name' => 'action_status', // the method that defines the relationship in your Model
                'entity' => 'action_status', // the method that defines the relationship in your Model
                'attribute' => "description" // foreign key attribute that is shown to user
                // 'model' => "App\Models\Opportunity_status", // foreign key model
            ]);

            $this->crud->addColumn([
                // n-n relationship (with pivot table)
                'label' => trans('general.types'), // Table column heading
                'type' => 'label_multiple',
                'name' => 'action_types', // the method that defines the relationship in your Model
                'entity' => 'action_types', // the method that defines the relationship in your Model
                'attribute' => "description", // foreign key attribute that is shown to user
                'model' => "App\Models\Action_type", // foreign key model
            ]);

            $this->crud->addColumn([
                // 1-n relationship
                'label' => trans('general.assigned_to'), // Table column heading
                'type' => "select",
                'name' => 'assigned_to', // the column that contains the ID of that connected entity;
                'entity' => 'user_assigned_to', // the method that defines the relationship in your Model
                'attribute' => "name", // foreign key attribute that is shown to user
                'model' => "App\User", // foreign key model
            ]);

            // dump($this->crud);
            // $this->crud->addField([
            //     'label' => trans('informacrm.opportunity'),
            //     'type' => 'select2_nohtml',
            //     'name' => 'opportunity_id', // the db column for the foreign key
            //     'entity' => 'opportunity', // the method that defines the relationship in your Model
            //     'attribute' => 'description', // foreign key attribute that is shown to user
            //     'model' => "App\Models\Opportunity", // foreign key model
            //     'wrapperAttributes' => [
            //         'class' => 'form-group col-md-12'
            //     ]
            // ]);
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

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
        $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

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
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
        // $this->crud->addClause('actionStatusClosed');

    }

    public function search()
    {
        // $this->crud->addClause('where', 'assigned_to', '=', 2);
        return parent::search();
    }

    public function index()
    {
        $actionStatusOpened = Action_status::actionStatusOpened();
        if ( Auth::user()->hasPermissionTo('show actions of all users') ) {
            return redirect('admin/action_list?status='.implode(",",$actionStatusOpened).'&users='.Auth::user()->id);
        }else{
            return redirect('admin/action_list?status='.implode(",",$actionStatusOpened));
        }
        // dump(implode(",",$actionStatusClosed));

        // dump($this->crud);
        // return parent::index();
    }

    public function list()
    {
        return parent::index();
        // // $this->crud->parameters['status'] = '["3"]';
        // // dump($this->crud);
        // $actionStatusClosed = Action_status::actionStatusClosed();
        // // dump(implode(",",$actionStatusClosed));
        // return redirect('admin/action?status='.implode(",",$actionStatusClosed));
        // // return parent::index();
    }

    public function account_tab_actions($account_id, $action_status_id = null)
    {

        $data['actions'] = Action::where('account_id', '=', $account_id);
        $data['countActionStatuses'] = Action_status::countActions($account_id)->get();
        $data['countActionTypes'] = Action_type::countActions($account_id)->get();
        $data['active_account_id']['id'] = $account_id;
        // $filter = new CrudFilter($options, $values, $filter_logic);
        // $data['filter']['name'] = 'filtro1';
        if (!$action_status_id){
            //active first action_status
            $data['actions']->where('action_status_id', '=', $data['countActionStatuses'][0]->id);
            $viewReturn = 'inf.accounts.tabs.actions.actions';
        }else{
            $data['actions']->where('action_status_id', '=', $action_status_id);
            $viewReturn = 'inf.accounts.tabs.actions.details';
        }
        $data['actions'] = $data['actions']->get();
        return view($viewReturn, $data);
    }

    public function test()
    {
        $data['listaAzioni'] = Action::All();
        return response()->json(['view' => view('inf.actions', compact('data'))->render()]);
        // return view('inf.actions', $data);
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        // dd($request);

        switch ( $request['all_day'] ) {
            case -1:
                $request['start_date'] = null;
                $request['end_date'] = null;
                break;

            case 0:
                break;

            case 1:
                list($dateStart, $timeStart) = explode(' ', $request['start_date']);
                $request['start_date'] = $dateStart;
                $request['end_date'] = $dateStart." 23:59:59";
                break;

            default:
                break;
        }


        $request['created_by'] = Auth::user()->id;
        if ( $request['assigned_to'] <= 0) {
            $request['assigned_to'] = Auth::user()->id;
        }

        $redirect_location = parent::storeCrud($request);
        // // your additional operations after save here
        // // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    // public function edit($id)
    // {
    //     $parsed = \Route::current();
    //     // $parsed = \Route::current()->parameter('user_id');
    //     dd($parsed);
    //     parse_str($parsed['path'], $query_params);
    //     $active_tab = $query_params['call_url'];
    //     $this->crud->setRoute(config('backpack.base.route_prefix') . $active_tab);
    //     return parent::edit($id);
    // }

    // public function update(UpdateRequest $request)
    // {
    //     // your additional operations before save here
    //     if ( $request['created_by'] == "") {
    //         $request['created_by'] = Auth::user()->name;
    //     }
    //     $request['updated_by'] = Auth::user()->name;
    //     $request['end_date'] = $request['start_date'];
    //     if ( $request['all_day'] == 0 ) {
    //
    //     } else {
    //         $request['end_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request['start_date']);
    //     }
    //     $redirect_location = parent::updateCrud($request);
    //
    // }

    public function update(UpdateRequest $request)
    {

        // your additional operations before save here
        if ( $request['created_by'] <= 0) {
            $request['created_by'] = Auth::user()->id;
        }
        $request['updated_by'] = Auth::user()->id;
        if ( $request['assigned_to'] <= 0) {
            $request['assigned_to'] = Auth::user()->id;
        }


        switch ( $request['all_day'] ) {
            case -1:
                $request['start_date'] = null;
                $request['end_date'] = null;
                break;

            case 0:
                break;

            case 1:
                list($dateStart, $timeStart) = explode(' ', $request['start_date']);
                $request['start_date'] = $dateStart;
                $request['end_date'] = $dateStart." 23:59:59";
                break;

            default:
                break;
        }
        // if ( $request['all_day'] == 0 ) {
        //
        // } else {
        //     $request['start_date'] = $dateStart;
        //     $request['end_date'] = $dateStart." 23:59:59";
        // }

        // $redirect_location = parent::updateCrud($request);
        return parent::updateCrud($request);
        // $account_id = \Route::current()->parameter('account_id');
        // $action_id = \Route::current()->parameter('action');
        // // set a different route for the admin panel buttons
        // $this->crud->setRoute("admin/account/".$account_id."/action");
        // $saveAction = $this->getSaveAction()['active']['value'];
        // switch ($saveAction) {
        //     case 'save_and_edit':
        //         break;
        //     case 'save_and_new':
        //         $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$account_id.'/'.$action_id.'/create');
        //         break;
        //     case 'save_and_back':
        //     default:
        //         $redirect_location = redirect('admin/account/'.$account_id.'#actions');
        //         break;
        // }
        // // your additional operations after save here
        // // use $this->data['entry'] or $this->crud->entry
        // return $redirect_location;
    }
}
