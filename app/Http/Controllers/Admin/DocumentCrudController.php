<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use App\Models\Document_status;
use App\Models\Document_type;
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\DocumentRequest as StoreRequest;
use App\Http\Requests\DocumentRequest as UpdateRequest;

class DocumentCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Document');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/document');
        $this->crud->setEntityNameStrings('document', 'documents');

        $this->crud->setShowView('inf.documents.show');
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->setBoxOptions('basic', [
            'side' => false,         // Place this box on the right side?
            'class' => "box-default",  // CSS class to add to the div. Eg, <div class="box box-info">
            'collapsible' => false,
            'viewNameBox' => false,
            'collapsed' => false,    // Collapse this box by default?
        ]);

        $this->crud->setBoxOptions('info', [
            'side' => true,         // Place this box on the right side?
            'class' => "box-info",  // CSS class to add to the div. Eg, <div class="box box-info">
            'collapsible' => false,
            'viewNameBox' => false,
            'collapsed' => false,    // Collapse this box by default?
        ]);

        // dd($this->crud->model->getAcudAttribute());
        // $acud = $this->crud->model->getAcudAttribute();
        //
        // dd($acud,$this);
        // $this->crud->addField([
        //     'name' => 'custom-ajax-button',
        //     'type' => 'acud',
        //     'acud' => $acud
        // ]);


        // $action_id = \Route::current()->parameter('action');
        // // dump($action_id);
        // if ( $action_id > 0 ) {
        //     if ( Auth::user()->hasPermissionTo('change the action account') ) {
        //         // dump('pippo');
        //         $disabled = '';
        //     }else{
        //         // dump('pluto');/
        //         $disabled = 'disabled';
        //     };
        // } else {
        //     $disabled = '';
        // }

        $disabled = '';
        // dump($disabled);
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
                'class' => 'form-group col-md-12 required'
            ]
        ]);

        $this->crud->addField([
            'label' => trans('general.types'),
            'type' => 'select',
            'name' => 'document_type_id', // the db column for the foreign key
            'entity' => 'document_type', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Document_type", // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6 required'
            ],
            'box' => 'basic'
        ]);

        $this->crud->addField([
            'label' => trans('general.status'),
            'type' => 'select',
            'name' => 'document_status_id', // the db column for the foreign key
            'entity' => 'document_status', // the method that defines the relationship in your Model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'model' => "App\Models\Document_status", // foreign key model
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6 required'
            ],
            'box' => 'basic'
        ]);

        $this->crud->addField([   // WYSIWYG Editor
            'name' => 'description',
            'label' => trans('general.description'),
            'type' => 'ckeditor',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12 required'
            ],
            'box' => 'basic'
        ]);

        $this->crud->addField(
            [   // DateTime
                'name' => 'expiration_date',
                'label' => trans('general.expiration_date'),
                'type' => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'it'
                ],
                'allows_null' => true,
                'box' => 'info'
            ]);

        $this->crud->addField(
            [ // Text
                'name' => 'version',
                'label' => trans('general.version'),
                'type' => 'text',
                'box' => 'info'
            ]);

        $this->crud->addField(
            [   // Checkbox
                'name' => 'extracted',
                'label' => trans('general.extracted'),
                'type' => 'checkbox',
                'box' => 'info'
            ]);

            $this->crud->addField(
                [       // Select2Multiple = n-n relationship (with pivot table)
                    'label' => trans('general.attachments'),
                    'type' => 'select2_multiple',
                    'name' => 'attachments', // the method that defines the relationship in your Model
                    'entity' => 'attachments', // the method that defines the relationship in your Model
                    'attribute' => 'title', // foreign key attribute that is shown to user
                    'model' => "App\Models\Attachment", // foreign key model
                    'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                    // 'select_all' => true, // show Select All and Clear buttons?
                ]);
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'name' => 'id', // The db column name
            'label' => trans('general.id'), // Table column heading
            'type' => "model_function",
            'function_name' => 'getShowIdLink', // the method in your Model
        ]);

        $this->crud->addColumn([
            // run a function on the CRUD model and show its return value
            'name' => "descriptionlink",
            'label' => trans('general.description'), // Table column heading
            'type' => "model_function",
            'function_name' => 'getShowDescriptionLink', // the method in your Model
            'limit' => 150,
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere('description', 'like', '%'.$searchTerm.'%');
            },
            // 'orderable' => true
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
            // n-n relationship (with pivot table)
            'label' => trans('general.statuses'), // Table column heading
            'type' => 'label',
            'name' => 'document_status', // the method that defines the relationship in your Model
            'entity' => 'document_status', // the method that defines the relationship in your Model
            'attribute' => "description" // foreign key attribute that is shown to user
            // 'model' => "App\Models\Opportunity_status", // foreign key model
        ]);

        $this->crud->addColumn([
            // n-n relationship (with pivot table)
            'label' => trans('general.types'), // Table column heading
            'type' => 'label',
            'name' => 'document_type', // the method that defines the relationship in your Model
            'entity' => 'document_type', // the method that defines the relationship in your Model
            'attribute' => "description" // foreign key attribute that is shown to user
            // 'model' => "App\Models\Opportunity_status", // foreign key model
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

        // ------ CRUD ACCESS
        $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete', 'show']);
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

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
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

        // dd($this->data['entry']->attachments);
        $this->data['crud'] = $this->crud;
        $this->data['title'] = trans('backpack::crud.preview').' '.$this->crud->entity_name;
        $this->data['acud'] = Document::find($id)->acud;

        // remove preview button from stack:line
        $this->crud->removeButton('preview');
        $this->crud->removeButton('delete');
        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getShowView(), $this->data);
    }

    public function account_tab_documents($account_id, $document_status_id = null)
    {
        // dump($account_id, $document_status_id );
        $data['documents'] = Document::where('account_id', '=', $account_id);
        $data['countDocumentStatuses'] = Document_status::countDocuments($account_id)->get();
        $data['countDocumentTypes'] = Document_type::countDocuments($account_id)->get();
        $data['active_account_id']['id'] = $account_id;
        // $filter = new CrudFilter($options, $values, $filter_logic);
        // $data['filter']['name'] = 'filtro1';
        if (!$document_status_id){
            //active first action_status
            $data['documents']->where('document_status_id', '=', $data['countDocumentStatuses'][0]->id);
            $viewReturn = 'inf.accounts.tabs.documents.documents';
        }else{
            $data['documents']->where('document_status_id', '=', $document_status_id);
            $viewReturn = 'inf.accounts.tabs.documents.details';
        }
        $data['documents'] = $data['documents']->get();
        return view($viewReturn, $data);
    }
}
