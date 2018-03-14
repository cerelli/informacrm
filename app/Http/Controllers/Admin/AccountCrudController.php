<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Auth;
use Request;
use App\Models\Account;
use App\Models\Account_type;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AccountRequest as StoreRequest;
use App\Http\Requests\AccountRequest as UpdateRequest;

class AccountCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Account');
        $this->crud->setRoute(config('backpack.base.route_prefix','admin') . '/account');
        $this->crud->setEntityNameStrings(trans('informacrm.account'), trans('informacrm.accounts'));
        $this->crud->setShowView('inf.accounts.show');
        // $this->crud->setRoute("admin/account/".$account_id."/action");
        $account_id = \Route::current()->parameter('account');
        // $this->crud->setRoute("admin/account/".$account_id);
        $this->crud->cancelRoute = ("admin/account/".$account_id);
        // $this->crud->setEditView('inf/accounts/edit_account');
        // $this->crud->setCreateView('inf/accounts/tabs/create_contact_from_account');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // // ------- FILTERS
        // $this->crud->addFilter([ // add a "simple" filter called Draft
        //     'type' => 'simple',
        //     'name' => 'is_blocked',
        //     'label'=> 'is_blocked'
        // ],
        // false, // the simple filter has no values, just the "Draft" label specified above
        // function() { // if the filter is active (the GET parameter "draft" exits)
        //     $this->crud->addClause('where', 'is_blocked', '0');
        //     // we've added a clause to the CRUD so that only elements with draft=1 are shown in the table
        //     // an alternative syntax to this would have been
        //     // $this->crud->query = $this->crud->query->where('draft', '1');
        //     // another alternative syntax, in case you had a scopeDraft() on your model:
        //     // $this->crud->addClause('draft');
        // });

        // $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->addField([   // Hidden
            'name' => 'created_by',
            'type' => 'hidden',
            'attribute' => 'pippo',
        ],'show');


        //
        // $this->crud->addField([
        //     'name' => 'from_url', // JSON variable name
        //     'label' => "from_url", // human-readable label for the input
        //     // 'type' => 'hidden',
        //     'default' => 'valore di default',
        //     'fake' => true, // show the field, but don’t store it in the database column above
        //     'store_in' => '' // [optional] the database column name where you want the fake fields to be stored as a JSON array
        // ]);


        $this->crud->addField([
            'label' => trans('informacrm.title'),
            'type' => 'select',
            'name' => 'title_id', // the db column for the foreign key
            'entity' => 'title', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Title", // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
        ]);
        $this->crud->addField([
            'name' => 'is_person',
            'label' => trans('informacrm.is_persona'),
            'type' => 'checkbox',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-9',
                'style' => 'margin-top: 20px'
            ]
        ]);
        $this->crud->addField([
            'name' => 'name1',
            'type' => 'text',
            'label' => trans('informacrm.name1'),
            'hint'       => 'Testo di aiuto',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);
        $this->crud->addField([
            'name' => 'name2',
            'type' => 'text',
            'label' => trans('informacrm.name2'),
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);
        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => trans('informacrm.account_types'),
                'type' => 'select2_multiple_color',
                'name' => 'account_types', // the method that defines the relationship in your Model
                'entity' => 'account_types', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Account_type", // foreign key model
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            ]);

        $this->crud->addField([   // WYSIWYG Editor
            'name' => 'notes',
            'label' => trans('informacrm.account_notes'),
            'type' => 'ckeditor'
        ]);
        $this->crud->addField([
            'name' => 'vat_number',
            'type' => 'text',
            'label' => trans('informacrm.vat_number'),
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);
        $this->crud->addField([
            'name' => 'fiscal_code',
            'type' => 'text',
            'label' => trans('informacrm.fiscal_code'),
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn([
        //     'name' => 'fullname',
        //     'label' => '',
        //     'type' => 'text',
        // ]);


        $this->crud->addColumn([
            // run a function on the CRUD model and show its return value
            'name' => "fullname",
            'label' => trans('informacrm.fullname'), // Table column heading
            'type' => "model_function",
            'function_name' => 'getShowAccountLink', // the method in your Model
        ]);
        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'label' => trans('informacrm.account_types'), // Table column heading
            'type' => 'label_multiple',
            'name' => 'account_types', // the method that defines the relationship in your Model
            'entity' => 'account_types', // the method that defines the relationship in your Model
            'attribute' => "description", // foreign key attribute that is shown to user
            'model' => "App\Models\Account_type", // foreign key model
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
        // $this->crud->addButtonFromView('line', 'testbutton', 'testbutton', 'beginning');
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        //$this->crud->removeAllButtons();


        // dump($this->crud->hasAccess('create-account'));
        $this->crud->removeButton( 'preview' );
        $this->crud->removeButton( 'update' );
        $this->crud->removeButton( 'revisions' );
        $this->crud->removeButton( 'delete' );
        // $this->crud->removeAllButtonsFromStack('line');
        // $this->crud->addButtonFromModelFunction('line', 'open_google', 'openGoogle', 'beginning'); // add a button whose HTML is returned by a method in the CRUD model

        // ------ CRUD ACCESS
        $this->crud->allowAccess('show','create');
        if (Auth::user()->can('create-account')){

        }else{
            $this->crud->removeButton( 'create' );
        }
        // if (Auth::user()->can('delete-account')){
        //
        // }else{
        //     $this->crud->removeButton( 'delete' );
        // }
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
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
        // if (Auth::user()->hasRole('root')) {
        //     $this->crud->addClause('where', 'name1', '=', 'Marco');
        // }

        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with('actions'); // eager load relationships
        // $this->crud->with('events');
        // $this->crud->with('event_types');
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {

        $this->crud->hasAccessOrFail('show');
        // Cache::forever('active_account_id', $id);
        $view = parent::show($id);
        return $view;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $this->crud->hasAccessOrFail('update');
        $view = parent::edit($id);
        return $view;
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        // dd($request);
        $request['created_by'] = Auth::user()->name;
        // echo "<br>ABC Controller.";

        $redirect_location = parent::storeCrud($request);
        $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$this->crud->entry->id);
        // dump($redirect_location);
        // // your additional operations after save here
        // // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }


    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        if ( $request['created_by'] == "") {
            $request['created_by'] = Auth::user()->name;
        }
        $request['updated_by'] = Auth::user()->name;
        $parsed = parse_url(url()->previous());
        parse_str($parsed['query'], $query_params);
        $active_tab = $query_params['call_url'];
        $redirect_location = parent::updateCrud($request);

        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/create?call_url='.$active_tab);
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$this->crud->entry['id'].'#'.$active_tab);
                break;
        }
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

}
