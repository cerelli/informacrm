<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Support\Facades\DB;
use App\Models\Action;
use App\Models\Action_status;
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
        $this->crud->setEntityNameStrings('action', 'actions');
        $this->crud->setListView('inf.action');
        // dump($this->crud);
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        $this->crud->addFilter([ // select2_multiple filter
            'name' => 'action',
            'type' => 'select2_multiple',
            'label'=> trans('informacrm.account_types')
        ], function() { // the options that show up in the select2
            return [
            1 => 'In stock',
            2 => 'In provider stock',
            3 => 'Available upon ordering',
            4 => 'Not available',
            ];
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'status', $value);
        });
        // ------ CRUD FIELDS
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
    }

    public function account_tab_actions($account_id, $action_status_id = null)
    {
        $data['actions'] = Action::where('account_id', '=', $account_id);
        $data['countActionStatuses'] = Action_status::countActions($account_id)->get();
        $data['active_account_id']['id'] = $account_id;
        if (!$action_status_id)
        {
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
        $request['created_by'] = Auth::user()->name;
        // echo "<br>ABC Controller.";

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

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        if ( $request['created_by'] == "") {
            $request['created_by'] = Auth::user()->name;
        }
        $request['updated_by'] = Auth::user()->name;
        $redirect_location = parent::updateCrud($request);

    }
}
