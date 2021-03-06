<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AddressRequest as StoreRequest;
use App\Http\Requests\AddressRequest as UpdateRequest;

use App\Models\Account;
use Auth;
use Illuminate\Http\Request;

class AddressCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Address');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/address');
        $this->crud->setEntityNameStrings(trans('general.address'), trans('general.addresses'));

        $account_id = \Route::current()->parameter('account_id');
        $this->crud->setRoute("admin/account/".$account_id."/address");
        $this->crud->cancelRoute = ("admin/account/".$account_id."#addresses");
        // $this->crud->setEditView('inf/accounts/tabs/edit_address_from_account');
        // $this->crud->setCreateView('inf/accounts/tabs/create_address_from_account');
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
        // ------ CRUD FIELDS
        $this->crud->addField([
            'name' => 'account_id',
            'label' => trans('informacrm.account_id'),
            'type' => 'hidden',
            'box' => 'basic'
        ]);

        $this->crud->addField([
            'label' => trans('informacrm.address_type'),
            'type' => 'select2',
            'name' => 'address_type_id', // the db column for the foreign key
            'entity' => 'address_type', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Address_type", // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name'              => 'address',
            'label'             => trans('informacrm.address_find'),
            'type'              => 'address_form_google',
            'google_api_key'    => env('GOOGLE_API_KEY'),


            'components' =>  [
                'route' => [
                    'name'  => 'address_line_1',
                    'label' => trans('informacrm.address_line1'),
                    'type'  => 'long_name',
                    'class' => 'form-group col-md-9',
                ],
                'street_number' => [
                    'name'  => 'street_number',
                    'label' => trans('informacrm.street_number'),
                    'type'  => 'short_name',
                    'class' => 'form-group col-md-3',
                ],
                'postal_code' => [
                    'name'  => 'postal_code',
                    'label' => trans('informacrm.posta_code'),
                    'type'  => 'short_name',
                    'class' => 'form-group col-md-3',
                ],
                'locality' => [
                    'name'  => 'city',
                    'label' => trans('informacrm.city'),
                    'type'  => 'long_name',
                    'class' => 'form-group col-md-6',
                ],
                'administrative_area_level_1' => [
                    'name'  => 'region',
                    'label' => trans('informacrm.region'),
                    'type'  => 'long_name',
                    'class' => 'hidden',
                ],
                'administrative_area_level_2' => [
                    'name'  => 'province',
                    'label' => trans('informacrm.province'),
                    'type'  => 'short_name',
                    'class' => 'form-group col-md-3',
                ],
                'country' => [
                    'name'  => 'country',
                    'label' => trans('informacrm.country'),
                    'type'  => 'short_name',
                    'class' => 'form-group col-md-3',
                ],
            ],
        ]);
        $this->crud->addField([   // WYSIWYG Editor
            'name' => 'notes',
            'label' => trans('informacrm.address_notes'),
            'type' => 'ckeditor'
        ]);
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
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function create()
    {
        $account_id = \Route::current()->parameter('account_id');
        if ( $account_id > 0 ) {
            $account = Account::findOrFail($account_id);
            $this->crud->entity_name = $this->crud->entity_name.' '.trans('general.to').' '.$account->getFullNameAttribute();
        } else {

        }

        return parent::create();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $account_id = \Route::current()->parameter('account_id');
        $request['account_id'] = $account_id;
        $request['created_by'] = Auth::user()->name;
        //***************************ORIGINAL*********
        $redirect_location = parent::storeCrud($request);
        //********************************************
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$account_id.'/address/create');
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$account_id.'#addresses');
                break;
        }
        //***************************ORIGINAL********
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $account_id = \Route::current()->parameter('account_id');
        if ( $request['created_by'] == "") {
            $request['created_by'] = Auth::user()->name;
        }
        $request['updated_by'] = Auth::user()->name;

        $redirect_location = parent::updateCrud($request);
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$account_id.'/address/create');
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$account_id.'#addresses');
                break;
        }
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

        public function edit($parent_id, $id = null)
        {

            $address_id = \Route::current()->parameter('address');
            return parent::edit($address_id);
            // return $this->crud['nominativo'] = 'pippo';
        }

        public function destroy($parent_id, $id = null)
        {
            $address_id = \Route::current()->parameter('address');
            return parent::destroy($address_id);
        }
}
