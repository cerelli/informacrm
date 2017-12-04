<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\Inf_service_ticketRequest as StoreRequest;
use App\Http\Requests\Inf_service_ticketRequest as UpdateRequest;

use App\Models\Inf_service_ticket_status;
use App\Models\Inf_service_ticket_type;
use Illuminate\Http\Request;

class Inf_service_ticketCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Inf_service_ticket');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/service_ticket');
        $this->crud->setEntityNameStrings(trans('informacrm.service_ticket'), trans('informacrm.service_tickets'));

        $this->crud->setEditView('inf/accounts/tabs/edit_service_ticket_from_account');
        $this->crud->setCreateView('inf/accounts/tabs/create_service_ticket_from_account');
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();

        $this->crud->addField([
            'name' => 'inf_account_id',
            'label' => trans('informacrm.inf_account_id'),
            'type' => 'hidden'
        ]);

        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => trans('informacrm.service_ticket_types').' *',
                'type' => 'select2_multiple_color',
                'name' => 'service_ticket_types', // the method that defines the relationship in your Model
                'entity' => 'service_ticket_types', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Inf_service_ticket_type", // foreign key model
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-9'
                ]
            ]);

            $this->crud->addField([
                'label' => trans('informacrm.service_ticket_status').' *',
                'type' => 'select',
                'name' => 'inf_service_ticket_status_id', // the db column for the foreign key
                'entity' => 'service_ticket_statuses', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Inf_service_ticket_status", // foreign key model
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3'
                ]
            ]);
        $this->crud->addField([   // WYSIWYG Editor
            'name' => 'description',
            'label' => trans('informacrm.service_ticket_description'),
            'type' => 'ckeditor'
        ]);


        $this->crud->addField([
            'label' => trans('informacrm.service_ticket_result'),
            'type' => 'select',
            'name' => 'inf_service_ticket_result_id', // the db column for the foreign key
            'entity' => 'service_ticket_results', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Inf_service_ticket_result", // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);


        $this->crud->addField([   // WYSIWYG Editor
            'name' => 'result_description',
            'label' => trans('informacrm.service_ticket_result_description'),
            'type' => 'text'
        ], 'update/create/both');
        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        $this->crud->addFilter([ // select2_multiple filter
          'name' => 'status',
          'type' => 'select2_multiple',
          'label'=> trans('informacrm.service_ticket_status')
        ], function() {
                $statuses = Inf_service_ticket_status::all();
                $statusList = [];
                $statuses->each(function ($s) use (&$statusList) {
                    $statusList[$s->id] = $s->description;
                });

                return $statusList;
        }, function($values) { // if the filter is active
            if (isset($values)) {
                foreach (json_decode($values) as $key => $value) {
                    if ( $value->count()>0 ) {
                        if ($key == 0) {
                            $this->crud->addClause('where', 'inf_service_ticket_status_id', $value);
                        } else {
                            $this->crud->addClause('orWhere', 'inf_service_ticket_status_id', $value);
                        }
                    } else {
                        $this->crud->removeFilter('status');
                    }
                }
            }
        });

        $this->crud->addFilter([ // select2_multiple filter
          'name' => 'service_ticket_types',
          'type' => 'select2_multiple',
          'label'=> trans('informacrm.service_ticket_types')
        ], function() {
                $service_ticket_types = Inf_service_ticket_type::all();
                $service_ticket_typesList = [];
                $service_ticket_types->each(function ($s) use (&$service_ticket_typesList) {
                    $service_ticket_typesList[$s->id] = $s->description;
                });
                // return Inf_opportunity_type::all()->pluck('description', 'id')->toArray();
                return $service_ticket_typesList;
        }, function($values) { // if the filter is active
            foreach (json_decode($values) as $key => $value) {
                $this->crud->query = $this->crud->query->whereHas('service_ticket_types', function ($query) use ($value) {
                    $query->where('service_ticket_types.service_ticket_type_id', $value);
                });
            }
        });
        // ------ CRUD COLUMNS
                $this->crud->addColumn([
                    'name' => 'id', // The db column name
                    'label' => trans('informacrm.id'), // Table column heading
                    'type' => "model_function",
                    'function_name' => 'getShowIdLink', // the method in your Model
                ]);

                $this->crud->addColumn([
                    'name' => "account",
                    'label' => trans('informacrm.inf_account'), // Table column heading
                    'type' => "model_function",
                    'function_name' => 'getShowAccountLink',
                ]);

                $this->crud->addColumn([
                    // n-n relationship (with pivot table)
                    'label' => trans('informacrm.service_ticket_status'), // Table column heading
                    'type' => 'label',
                    'name' => 'service_ticket_status', // the method that defines the relationship in your Model
                    'entity' => 'service_ticket_status', // the method that defines the relationship in your Model
                    'attribute' => "description" // foreign key attribute that is shown to user
                    // 'model' => "App\Models\Inf_opportunity_status", // foreign key model
                ]);

                $this->crud->addColumn([
                    // n-n relationship (with pivot table)
                    'label' => trans('informacrm.service_ticket_types'), // Table column heading
                    'type' => 'label_multiple',
                    'name' => 'service_ticket_types', // the method that defines the relationship in your Model
                    'entity' => 'service_ticket_types', // the method that defines the relationship in your Model
                    'attribute' => "description", // foreign key attribute that is shown to user
                    'model' => "App\Models\Inf_service_ticket_type", // foreign key model
                ]);

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
        $this->crud->removeButton( 'create' );
        $this->crud->removeButton( 'preview' );
        $this->crud->removeButton( 'update' );
        $this->crud->removeButton( 'revisions' );
        $this->crud->removeButton( 'delete' );

        // ------ CRUD ACCESS
        $this->crud->allowAccess('show','create');
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        $this->crud->enableDetailsRow();
        $this->crud->allowAccess('details_row');
        $this->crud->setDetailsRowView('inf.details_row.service_ticket');
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

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $request['created_by'] = \Auth::user()->name;

        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/service_ticket/create?active_account_id='.$this->crud->entry['inf_account_id']);
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$this->crud->entry['inf_account_id'].'#service_tickets');
                break;
        }
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        if ( $request['created_by'] == "") {
            $request['created_by'] = \Auth::user()->name;
        }
        $request['updated_by'] = \Auth::user()->name;
        $parsed = parse_url(url()->previous());
        // dd($parsed);
        parse_str($parsed['query'], $query_params);
        $call_url = $query_params['call_url'];
        $call = $query_params['call'];

        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/service_ticket/create?call_url='.$call_url);
                break;
            case 'save_and_back':
            default:
            $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/'.$call_url.'#service_tickets');
            break;
        }
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
