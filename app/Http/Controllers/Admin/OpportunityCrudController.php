<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\OpportunityRequest as StoreRequest;
use App\Http\Requests\OpportunityRequest as UpdateRequest;

use App\Models\Opportunity_status;
use App\Models\Opportunity_type;
use Illuminate\Http\Request;

class OpportunityCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Opportunity');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/opportunity');
        $this->crud->setEntityNameStrings(trans('informacrm.opportunity'), trans('informacrm.opportunities'));
        $this->crud->setEditView('inf/accounts/tabs/edit_opportunity_from_account');
        $this->crud->setCreateView('inf/accounts/tabs/create_opportunity_from_account');
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();
        $this->crud->addField([
            'name' => 'account_id',
            'label' => trans('informacrm.account_id'),
            'type' => 'hidden',
            'wrapperAttributes' => [
                'id' => 'account_id'
            ]
        ]);

        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => trans('informacrm.opportunity_types').' *',
                'type' => 'select2_multiple_color',
                'name' => 'opportunity_types', // the method that defines the relationship in your Model
                'entity' => 'opportunity_types', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Opportunity_type", // foreign key model
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-9'
                ]
            ]);

            $this->crud->addField([
                'label' => trans('informacrm.opportunity_status').' *',
                'type' => 'select',
                'name' => 'opportunity_status_id', // the db column for the foreign key
                'entity' => 'opportunity_statuses', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Opportunity_status", // foreign key model
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3'
                ]
            ]);
        $this->crud->addField([   // WYSIWYG Editor
            'name' => 'description',
            'label' => trans('informacrm.opportunity_description'),
            'type' => 'ckeditor'
        ]);

        // $this->crud->addField(
        //     [   // Date
        //         'name' => 'expiration_date',
        //         'label' => trans('informacrm.opportunity_expiration_date'),
        //         'type' => 'date'
        //     ]
        // );

        $this->crud->addField(
            [   // Number
                'name' => 'value',
                'label' => trans('informacrm.opportunity_value'),
                'type' => 'number',
                // optionals
                'attributes' => ["step" => "any"], // allow decimals
                'prefix' => "€",
                'suffix' => ",00",
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6'
                ]
            ]
        );

        $this->crud->addField(
            [   // date_picker
                'name' => 'expiration_date',
                'type' => 'datetime_picker',
                'label' => trans('informacrm.opportunity_expiration_date'),
                // optional:
                'date_picker_options' => [
                    'todayBtn' => 'linked',
                    'format' => 'dd/mm/yyyy  HH:mm',
                    'language' => 'it',
                    'autoclose' => 'true'
                ],
           'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
           ]
            ]
        );

        $this->crud->addField([
            'label' => trans('informacrm.opportunity_result_id'),
            'type' => 'select_opportunity_result',
            'name' => 'opportunity_result_id', // the db column for the foreign key
            'entity' => 'opportunity_results', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Opportunity_result", // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([   // WYSIWYG Editor
            'name' => 'result_description',
            'label' => trans('informacrm.opportunity_result_description'),
            'type' => 'text',
            'wrapperAttributes' => [
                'id' => 'id_result_description'
            ]
        ], 'update/create/both');

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addFilter([ // simple filter
        //     'type' => 'simple',
        //     'name' => 'active',
        //     'label'=> 'Active'
        // ],
        // false,
        // function() { // if the filter is active
        //     $this->crud->addClause('where', 'opportunity_status_id', 1); // apply the "active" eloquent scope
        // } );
        $this->crud->addFilter([ // select2_multiple filter
          'name' => 'status',
          'type' => 'select2_multiple',
          'label'=> trans('informacrm.opportunity_status')
        ], function() {
                $statuses = Opportunity_status::all();
                $statusList = [];
                $statuses->each(function ($s) use (&$statusList) {
                    $statusList[$s->id] = $s->description;
                });

                return $statusList;
        }, function($values) { // if the filter is active
            if (isset($values)) {
                foreach (json_decode($values) as $key => $value) {
                    if ($key == 0) {
                        $this->crud->addClause('where', 'opportunity_status_id', $value);
                    } else {
                        $this->crud->addClause('orWhere', 'opportunity_status_id', $value);
                    }

                }
            }
        });

        $this->crud->addFilter([ // select2_multiple filter
          'name' => 'opportunity_types',
          'type' => 'select2_multiple',
          'label'=> trans('informacrm.opportunity_types')
        ], function() { // the options that show up in the select2
            return Opportunity_type::all()->pluck('description', 'id')->toArray();
        }, function($values) { // if the filter is active
            foreach (json_decode($values) as $key => $value) {
                // $this->crud->addClause('where', 'opportunity_types', $value);
                $this->crud->query = $this->crud->query->whereHas('opportunity_types', function ($query) use ($value) {
                    if ( $value == "" ) {

                    } else {
                        $query->where('opportunity_type_id', '=', $value);
                    }
                });
            }
        });



        $this->crud->addColumn([
            'name' => 'id', // The db column name
            'label' => trans('informacrm.id'), // Table column heading
            'type' => "model_function",
            'function_name' => 'getShowIdLink', // the method in your Model
        ]);

        $this->crud->addColumn([
            'name' => "account",
            'label' => trans('informacrm.account'), // Table column heading
            'type' => "model_function",
            'function_name' => 'getShowAccountLink',
        ]);

        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'label' => trans('informacrm.opportunity_status'), // Table column heading
            'type' => 'label',
            'name' => 'opportunity_status', // the method that defines the relationship in your Model
            'entity' => 'opportunity_status', // the method that defines the relationship in your Model
            'attribute' => "description" // foreign key attribute that is shown to user
            // 'model' => "App\Models\Opportunity_status", // foreign key model
        ]);

        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'label' => trans('informacrm.opportunity_types'), // Table column heading
            'type' => 'label_multiple',
            'name' => 'opportunity_types', // the method that defines the relationship in your Model
            'entity' => 'opportunity_types', // the method that defines the relationship in your Model
            'attribute' => "description", // foreign key attribute that is shown to user
            'model' => "App\Models\Opportunity_type", // foreign key model
        ]);

        $this->crud->addColumn([
            'name' => "value",
            'label' => trans('informacrm.opportunity_value'), // Table column heading
            'type' => "model_function",
            'function_name' => 'getValue'
        ]);
        // $this->crud->addColumn([
        //     // run a function on the CRUD model and show its return value
        //     'name' => "account",
        //     'label' => trans('informacrm.fullname'), // Table column heading
        //     'type' => "model_function",
        //     'function_name' => 'getShowAccountLink', // the method in your Model
        // ]);
        // $this->crud->addColumn([
        //     // n-n relationship (with pivot table)
        //     'label' => trans('informacrm.opportunity_types'), // Table column heading
        //     'type' => 'label_multiple',
        //     'name' => 'opportunity_types', // the method that defines the relationship in your Model
        //     'entity' => 'account_types', // the method that defines the relationship in your Model
        //     'attribute' => "description", // foreign key attribute that is shown to user
        //     'model' => "App\Models\Account_type", // foreign key model
        // ]);
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
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete','show']);
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
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
        $this->crud->setDetailsRowView('inf.details_row.opportunity');

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
        // $this->addCustomCrudFilters();
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
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/opportunity/create?active_account_id='.$this->crud->entry['account_id']);
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$this->crud->entry['account_id'].'#opportunities');
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
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/opportunity/create?call_url='.$call_url);
                break;
            case 'save_and_back':
            default:
            $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/'.$call_url.'#opportunities');
            break;
        }
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function showDetailsRow($id) {
        $data    = $this->crud->model->find($id);
        $address = $data->address()->first();

        if (isset($address)) {
            print view('customer/customeraddressdetails', ['data' => $address]);
        } else {
            print view('customer/customeraddaddress', ['id' => $id]);
        }
    }

}
