<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\Attachment;
use App\Models\Extraction;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AttachmentRequest as StoreRequest;
use App\Http\Requests\AttachmentRequest as UpdateRequest;

class AttachmentCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Attachment');
        $document_id = \Route::current()->parameter('document_id');
        // dd($document_id);
        // set a different route for the admin panel buttons
        // $this->crud->setRoute("admin/account/".$account_id."#actions");
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/document/'.$document_id.'/attachment');
        $this->crud->setEntityNameStrings('attachment', 'attachments');

        // $this->crud->setCreateView('inf.attachments.create_attachments');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        //
        $post_max_size = ini_get('post_max_size');

        $this->crud->addField([ // pdf
            'label' => trans('fisical_name MAX').' '.$post_max_size,
            'name' => "fisical_name",
            'type' => 'upload_multiple',
            'upload' => true,
        ]);

        $this->crud->addField([ // pdf
            'label' => "document_id",
            'name' => "document_id",
            'type' => 'text'
        ]);


$this->crud->addField([ // pdf
    'label' => "document_id",
    'name' => "extraction_id",
    'type' => 'text'
]);
        // $this->crud->addField([
        //     'label' => trans('informacrm.extraction'),
        //     'type' => 'select2',
        //     'name' => 'extraction_id', // the db column for the foreign key
        //     'entity' => 'extraction', // the method that defines the relationship in your Model
        //     'attribute' => 'attachment_id', // foreign key attribute that is shown to user
        //     'model' => "App\Models\Extraction", // foreign key model
        //     'wrapperAttributes' => [
        //         'class' => 'form-group col-md-3'
        //     ],
        // ]);
        // $this->crud->addField([
        //     'label' => 'Document 2',
        //     'name' => 'fisical_name',
        //     'type' => 'upload',
        //     'upload' => true,
        //     'prefix' => '/storage/',
        // ]);
        // $this->crud->setFromDb();

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

    // public function create()
    // {
    //     return parent::createCrud();
    // }

    public function create($id = null)
    {
        $this->crud->create_fields['document_id']['value'] = $id;

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
        // $active_account_id = $request['account_id'];

        $attribute_name = "fisical_name";
        $disk = "local";
        $destination_path = "local/".$request['document_id'];
        // dd($destination_path);
        // $this->uploadPdfToDisk($value, $attribute_name, $disk, $destination_path);
        $value = $request['fisical_name'];

        $filesSaved = $this->uploadMultipleAttachmentsToDisk($value, $attribute_name, $disk, $destination_path, $request);

        // $action_id = \Route::current()->parameter('action');
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
        //***************************ORIGINAL********
        return redirect(config('backpack.base.route_prefix') . '/document/'.$request['document_id']);
    }

    public function uploadMultipleAttachmentsToDisk($value, $attribute_name, $disk, $destination_path, $request)
    {
        // if a new file is uploaded, store it on disk and its filename in the database
        if ($request->hasFile($attribute_name)) {
            foreach ($request->file($attribute_name) as $file) {
                if ($file->isValid()) {
                    // 1. Generate a new file name
                    $originalName = $file->getClientOriginalName();
                    // find if the files exist
                    $searchfile = Attachment::
                                    where('original_name', '=', $originalName)
                                    ->where('path', '=', $destination_path)
                                    ->first();
                    if ( isset($searchfile) ) {
                        $filenameNoExt = str_replace('.'.$searchfile->extension, "",$searchfile->fisical_name);

                        $from = $searchfile->path.'/'.$searchfile->fisical_name;
                        $to = $searchfile->path.'/'.$filenameNoExt.'_'.$searchfile->version.'.'.$searchfile->extension;
                        Storage::move($from, $to);
                        $file_path = $file->storeAs($searchfile->path, $searchfile->fisical_name, $searchfile->disk);
                        $searchfile->version = $searchfile->version+1;
                        $searchfile->update();
                        //search attachment_document
                        $attachment_id = $searchfile->id;
                        $attachment_document = Attachment::whereHas('documents', function ($q) use ($attachment_id){
                            $q->where('attachment_id', '=', $attachment_id);
                        })->first();

                        // dd('esiste',$searchfile->id,$attachment_document);
                    } else {
                        $new_file_name =  md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();

                        // 2. Move the new file to the correct path
                        $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

                        // 3. Add the public path to the database
                        $attribute_value[] = $file_path;

                        $attachment = new Attachment();
                        $filenameNoExt = str_replace('.'.$file->getClientOriginalExtension(), "",$originalName);

                        $attachment->title = $filenameNoExt;
                        $attachment->original_name = $originalName;
                        $attachment->fisical_name = str_replace('"', "",$new_file_name);
                        $test = str_replace('"', "",$new_file_name);
                        // dump($test);
                        $attachment->disk = $disk;
                        $attachment->path = $destination_path;
                        $attachment->type = $file->getClientMimeType();
                        $attachment->extension = $file->getClientOriginalExtension();
                        $attachment->size = $file->getClientSize();
                        $attachment->extraction_id = null;
                        $attachment->version = 0;
                        $attachment->created_by = Auth::user()->id;
                        $attachment->save();
                        $attachment_id = $attachment->id;
                        $attachment_document = Attachment::whereHas('documents', function ($q) use ($attachment_id){
                            $q->where('attachment_id', '=', $attachment_id);
                        })->first();
                        if ( !isset($attachment_document) ) {
                            DB::table('attachment_document')->insert([
                                [
                                    'attachment_id' => $attachment_id,
                                    'document_id' => $request['document_id']
                                ]
                            ]);
                        }
                        // dd('nuovo',$attachment->id,$attachment_document);
                    }

                }
            }
        }

    }

    // public function buttons($document_id, $attachment_id){
    //     $attachment = Attachment::find($attachment_id);
    //     $extraction_id = $attachment->getExtractionIdAttribute();
    //     // dd($extraction_id,$attachment);
    //     $attachment->document_id = $document_id;
    //     return view('inf.attachments.buttons',['attachment' => $attachment]);
    // }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function unlock($document_id, $attachment_id)
    {
        $attachment = Attachment::find($attachment_id);
        if (!$attachment) {
            return 0;
        } else {
            // dd($attachment);
            if ( !$attachment->getOriginal('extraction_id') ) {
                //file not locked: lock
                return 0;
            } else {
                //file locked, unlock
                $extraction_id = $attachment->extraction_id;
                $extraction = Extraction::find($extraction_id);
                // $extraction->attachment_id = $attachment_id;
                $extraction->archived_by = Auth::user()->id;
                $extraction->archived_at = \Carbon\Carbon::now();
                // dump($extraction);
                $extraction->update();
                // dump($extraction);
                // dd($attachment);
                $attachment->extraction_id = null;
                $attachment->update();
                return 1;
                // return 'file già lock da '.$attachment->extraction->extracted_by()->first()->name;
            }
        }

    }

    public function lock($document_id, $attachment_id)
    {
        $attachment = Attachment::find($attachment_id);
        if (!$attachment) {
            return 0;
        } else {
            // dd($attachment);
            if ( !$attachment->getOriginal('extraction_id') ) {
                //file not locked: lock
                $extraction = new Extraction();
                $extraction->attachment_id = $attachment_id;
                $extraction->extracted_by = Auth::user()->id;
                $extraction->extracted_at = \Carbon\Carbon::now();
                // dump(\Carbon\Carbon::now()->timestamp);
                // dump(\Carbon\Carbon::now());
                $extraction->save();
                // dd($attachment);
                $attachment->extraction_id = $extraction->id;
                $attachment->update();
                return $attachment->getExtractionInfo();
            } else {
                // $fileStatus = "<strong><span style='color: red;'> Bloccato da ".$attachment->extraction->extracted_by()->first()->name." il  ".$attachment->extraction->extracted_at."</span></strong>";
                return 0;
                // return 'file già lock da '.$attachment->extraction->extracted_by()->first()->name;
            }
        }

    }
}
