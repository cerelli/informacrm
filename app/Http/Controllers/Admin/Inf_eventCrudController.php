<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\Inf_event;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\Inf_eventRequest as StoreRequest;
use App\Http\Requests\Inf_eventRequest as UpdateRequest;

use Auth;
use Illuminate\Http\Request;

class Inf_eventCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Inf_event');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/event');
        $this->crud->setEntityNameStrings(trans('informacrm.inf_event'), trans('informacrm.inf_events'));
        // $this->crud->setShowView('inf/accounts/tabs/create_event_from_account');
        // $this->crud->setListView('inf/calendar/events')
        $this->crud->setEditView('inf/accounts/tabs/edit_event_from_account');
        $this->crud->setCreateView('inf/accounts/tabs/create_event_from_account');

        // $this->crud->setRequiredFields(['title', 'event_types'], 'update/create/both');
        // $this->crud->setRequiredField('field_1', 'update/create/both');
        // $this->crud->getRequiredFields()

        // enabled/disables grouped errors at the top
        $this->crud->enableGroupedErrors();
        // $this->crud->disableGroupedErrors();

        // enables/disables inline errors
        // $this->crud->enableInlineErrors();
        $this->crud->disableInlineErrors();

        // check if grouped messages are enabled
        // $this->crud->isGroupedErrorsEnabled();

        // check if inline messages are enabled
        // $this->crud->isInlineErrorsEnabled();
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->addField([
            'name' => 'inf_account_id',
            'label' => trans('informacrm.inf_account_id'),
            'type' => 'hidden'
        ]);

        $this->crud->addField([
            'name' => 'title',
            'label' => trans('informacrm.event_title').' *',
            'type' => 'text'
        ]);

        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => trans('informacrm.event_types').' *',
                'type' => 'select2_multiple_color',
                'name' => 'event_types', // the method that defines the relationship in your Model
                'entity' => 'event_types', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Inf_event_type", // foreign key model
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-9'
                ]
            ]);

            $this->crud->addField([
                'label' => trans('informacrm.event_status').' *',
                'type' => 'select',
                'name' => 'inf_event_status_id', // the db column for the foreign key
                'entity' => 'event_statuses', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Inf_event_status", // foreign key model
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3'
                ]
            ]);

            $this->crud->addField([   // CustomHTML
                'name' => 'separator',
                'type' => 'custom_html',
                'value' => '',
                'wrapperAttributes' => [
                    'class' => 'row',
                    'style' => 'margin-top: 20px'
                ]
            ]);

            $this->crud->addField([   // Checkbox
                'name' => 'all_day',
                'label' => trans('informacrm.event_all_day'),
                'type' => 'checkbox',
                'default' => 0,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3'
                ]
            ]);
            $this->crud->addField([   // CustomHTML
                'name' => 'separator1',
                'type' => 'custom_html',
                'value' => '',
                'wrapperAttributes' => [
                    'class' => 'row',
                    'style' => 'margin-top: 20px'
                ]
            ]);
            $this->crud->addField([   // DateTime
                'name' => 'start_date',
                'label' => trans('informacrm.event_start'),
                'type' => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'it'
                ],
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6'
                ]
            ]);

            $this->crud->addField([   // DateTime
                'name' => 'end_date',
                'label' => trans('informacrm.event_end'),
                'type' => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'it'
                ],
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6'
                ]
            ]);

            $this->crud->addField([
                'label' => trans('informacrm.event_result_id'),
                'type' => 'select',
                'name' => 'inf_event_result_id', // the db column for the foreign key
                'entity' => 'event_results', // the method that defines the relationship in your Model
                'attribute' => 'description', // foreign key attribute that is shown to user
                'model' => "App\Models\Inf_event_result", // foreign key model
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-3'
                ]
            ]);


            $this->crud->addField([   // WYSIWYG Editor
                'name' => 'result_description',
                'label' => trans('informacrm.event_result_description'),
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

    public function calendar()
    {
        $events = [];
        $data = Inf_event::all();
        // dd($data);
        if($data->count()) {
            foreach ($data as $key => $value) {
                $backColor = (isset($value->event_status->background_color)) ? $value->event_status->background_color : '#ffffff' ;
                $textColor = (isset($value->event_status->color)) ? $value->event_status->color : '#000000' ;
                $events[] = Calendar::event(
                    $value->title.' - '.\Auth::user()->name,
                    $value->all_day,
                    new \DateTime($value->start_date),
                    // new \DateTime($value->end_date.' +1 day'),
                    new \DateTime($value->end_date),
                    $value->id,
                    // Add color and link on event
                 [
                     'color' => $backColor,
                     'textColor' => $textColor,
                     'url' => 'event/'.$value->id.'/edit?call_url=events_calendar&call=events_calendar',

                 ]
                );
            }
        }
        $calendar = Calendar::addEvents($events)
        ->setOptions([
            'defaultView' => 'listYear',
            'header' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'month,agendaWeek,agendaDay,listYear',
            ]
        ])
        ;

        // ->setOptions([
        //         'defaultView' => 'listDay',
        //         'header' =>
        //             [
        //                 'left' => 'prev,next today',
        //                 'center' => 'title',
        //                 'right' => 'month,agendaWeek,agendaDay,listDay',
        //             ]
        //     ])
        //     ->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
        //         'eventRender' => 'function(event, element) {
        // element.children().last().append(event.description);
        //     }'])
            // ;
        // dd($calendar);
        return view('inf.calendar.event_calendar', compact('calendar'));
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        // dd('qui');
        $request['created_by'] = \Auth::user()->name;

        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/event/create?active_account_id='.$this->crud->entry['inf_account_id']);
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$this->crud->entry['inf_account_id'].'#events');
                break;
        }
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        // dd('qui');
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

        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/event/create?call_url='.$call_url);
                break;
            case 'save_and_back':
            default:
                switch ($call) {
                    case 'events_calendar':
                        $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/'.$call_url);
                        break;
                    case 'account':
                        $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/'.$call_url.'#events');
                        break;
                    default:
                        $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/'.$call_url);
                        break;
                }
                break;
        }
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
