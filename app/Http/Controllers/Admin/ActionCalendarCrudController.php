<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Controllers\Admin\ActionCrudController;
use Auth;
use Illuminate\Http\Request;
use App\Models\Action;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\Http\Controllers\Controller;
use Response;

// use App\Models\Action;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ActionRequest as StoreRequest;
use App\Http\Requests\ActionRequest as UpdateRequest;

class ActionCalendarCrudController extends ActionCrudController {

    public function setup() {
        parent::setup();
        // get the user_id parameter
        // $account_id = \Route::current()->parameter('account_id');
        // $id = \Route::current()->parameter('action');
        // set a different route for the admin panel buttons
        // $this->crud->setRoute("admin/account/".$account_id."#actions");
        $this->crud->setRoute("admin/calendar/action");
        $this->crud->cancelRoute = ("admin/calendar");
        // dd($this->crud);
        // show only that user's posts
        // $this->crud->addClause('where', 'id', '==', $id);
        // dd($this->crud);
    }

    public function calendarAction()
    {
        $actions = [];
        $data = [];
        // $actions[] = Calendar::event();
        $data = Action::Expired()->get();

        // dd($data);
        // if($data->count()) {
            // foreach ($data as $key => $value) {
            //     $backColor = (isset($value->action_status->background_color)) ? $value->action_status->background_color : '#ffffff' ;
            //     $textColor = (isset($value->action_status->color)) ? $value->action_status->color : '#000000' ;
            //     $actions[] = Calendar::event(
            //         $value->title.' - '.\Auth::user()->name,
            //         $value->all_day,
            //         new \DateTime($value->start_date),
            //         // new \DateTime($value->end_date.' +1 day'),
            //         new \DateTime($value->end_date),
            //         $value->id,
            //         // Add color and link on event
            //      [
            //          'color' => $backColor,
            //          'textColor' => $textColor,
            //          'url' => 'action/'.$value->id.'/edit?call_url=actions_calendar&call=actions_calendar',
            //
            //      ]
            //     );
            // }
        // }
        // $calendar = $calendar::setOptions(['firstDay' => 1,]);

        // $calendar = Calendar::setOptions([
        //     'defaultView' => 'listYear',
        //     'header' => [
        //         'left' => 'prev,next today',
        //         'center' => 'title',
        //         'right' => 'month,agendaWeek,agendaDay,listYear',
        //     ]
        // ]);
        $calendar = Calendar::setId('my-calendar');

        return view('inf.calendar.action_calendar', compact('calendar', 'data'));
    }

    public function getActionEventsJson(Request $request) {
        $start = $_GET['start'];
        $end = $_GET['end'];
        // dd($start, $end);
        $actions = [];
        // $data = Event::all();
        $data = Action::where('start_date', '>=', $start)
        ->where('end_date', '<', $end)
        ->get();

        if($data->count()) {
            foreach ($data as $key => $value) {
                $backColor = (isset($value->action_status->background_color)) ? $value->action_status->background_color : '#ffffff' ;
                $textColor = (isset($value->action_status->color)) ? $value->action_status->color : '#000000' ;
                if ( $value->all_day == 0 ) {
                    $allDay = false;
                    $startDate = $value->start_date;
                    $endDate = $value->end_date;
                } else {
                    $allDay = true;
                    $startDate = $value->start_date;
                    $endDate = $value->start_date;
                }


                $eventsJson[] = array(
                    'id' => $value->id,
                    'title' => '['.$value->id.'] '.$value->title.' - '.\Auth::user()->name,
                    'url' => 'calendar/action/'.$value->id.'/edit',
                    'allDay' => $allDay,
                    'start' => $startDate,
                    'end' => $endDate,
                    'backgroundColor' => $backColor,
                    'textColor' => $textColor,
                    'resourceEditable' => true ,
                );
            }
        }
        // dd($eventsJson);
        return Response::json($eventsJson);
    }

    public function edit($parent_id, $id = null)
    {
        return parent::edit($parent_id);
    }

    public function destroy($parent_id, $id = null)
    {
        return parent::destroy($parent_id);
    }

    public function store(StoreRequest $request)
    {
        // // your additional operations before save here
        // $request['created_by'] = Auth::user()->name;
        // $account_id = \Route::current()->parameter('account_id');
        // $request['account_id'] = $account_id;
        // //***************************ORIGINAL*********
        // $redirect_location = parent::storeCrud($request);
        parent::store($request);
        //********************************************
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry

        // dump($request['account_id']);
        $action_id = \Route::current()->parameter('action');
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$account_id.'/'.$action_id.'/create');
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/account/'.$account_id.'#actions');
                break;
        }
        //***************************ORIGINAL********
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        parent::update($request);
        // $account_id = \Route::current()->parameter('account_id');
        $action_id = \Route::current()->parameter('action');
        // set a different route for the admin panel buttons
        $this->crud->setRoute("admin/calendar");
        $saveAction = $this->getSaveAction()['active']['value'];
        switch ($saveAction) {
            case 'save_and_edit':
                break;
            case 'save_and_new':
                $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/calendar/action/create');
                break;
            case 'save_and_back':
            default:
                $redirect_location = redirect('admin/calendar');
                break;
        }
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
    // public function update(UpdateRequest $request)
    // {
    //     // your additional operations before save here
    //     if ( $request['created_by'] == "") {
    //         $request['created_by'] = Auth::user()->name;
    //     }
    //     $request['updated_by'] = Auth::user()->name;
    //     list($dateStart, $timeStart) = explode(' ', $request['start_date']);
    //
    //     if ( $request['all_day'] == 0 ) {
    //
    //     } else {
    //         $request['start_date'] = $dateStart;
    //         $request['end_date'] = $dateStart." 23:59:59";
    //     }
    //
    //     $redirect_location = parent::updateCrud($request);
    //
    //     $account_id = \Route::current()->parameter('account_id');
    //     $action_id = \Route::current()->parameter('action');
    //     // set a different route for the admin panel buttons
    //     $this->crud->setRoute("admin/account/".$account_id."/action");
    //     $saveAction = $this->getSaveAction()['active']['value'];
    //     switch ($saveAction) {
    //         case 'save_and_edit':
    //             break;
    //         case 'save_and_new':
    //             $redirect_location = redirect(config('backpack.base.route_prefix', 'admin').'/account/'.$account_id.'/'.$action_id.'/create');
    //             break;
    //         case 'save_and_back':
    //         default:
    //             $redirect_location = redirect('admin/account/'.$account_id.'#actions');
    //             break;
    //     }
    //     // your additional operations after save here
    //     // use $this->data['entry'] or $this->crud->entry
    //     return $redirect_location;
    // }
}
