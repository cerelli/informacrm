<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Action;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\Http\Controllers\Controller;
use Response;

class CalendarActionController extends Controller
{

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

        // dd($data);
        if($data->count()) {
            foreach ($data as $key => $value) {
                $backColor = (isset($value->action_status->background_color)) ? $value->action_status->background_color : '#ffffff' ;
                $textColor = (isset($value->action_status->color)) ? $value->action_status->color : '#000000' ;
                $eventsJson[] = array(
                    'id' => $value->id,
                    'title' => $value->title.' - '.\Auth::user()->name,
                    'url' => 'action/'.$value->id.'/edit?call_url=actions_calendar&call=actions_calendar',
                    'start' => $value->start_date,
                    'end' => $value->end_date,
                    'allDay' => $value->all_day,
                    'color' => $backColor,
                    'textColor' => $textColor,
                    'resourceEditable' => true ,
                );

                // $actions[] = Calendar::event(
                //
                //     $value->all_day,
                //     new \DateTime($value->start_date),
                //     // new \DateTime($value->end_date.' +1 day'),
                //     new \DateTime($value->end_date),
                //     $value->id,
                //     // Add color and link on event
                //  [
                //      'color' => $backColor,
                //      'textColor' => $textColor,
                //      'url' => 'action/'.$value->id.'/edit?call_url=actions_calendar&call=actions_calendar',
                //
                //  ]
                // );
            }
        }
        // $events = CalendarEvent::wherePublic(1)->get();
        //
        // $eventsJson = array();
        // foreach ($events as $event) {
        //     $eventsJson[] = array(
        //         'id' => $event->id,
        //         'title' => $event->title,
        //         'url' => URL::to('events/event/' . date("Y/m/d/", strtotime($event->start_date)) . $event->slug),
        //         'start' => $event->start_date
        //     );
        // }
        return Response::json($eventsJson);
    }
}
