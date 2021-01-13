<?php

namespace App\Http\Controllers;

use App\Models\dayOfweek;
use Illuminate\Http\Request;
use App\Models\Event;

class FullCalendarController extends Controller
{
    //
    public function index()
    {

        $event = Event::take(1)->first();

        if ($event) {
            $title = $event->eventName;
            $start = $event->dateFrom;
            $end = $event->dateTo;

            $startdate = new \DateTime($start);
            $enddate = new \DateTime($end);
            $enddate = $enddate->modify('+1 day');

            $dow = dayOfweek::all();
            $Events = array();
            //loop to all dates
            while ($startdate != $enddate) {
                $dayfromdate = $startdate->format('l');

                //loop to all dayofweek
                foreach ($dow as $dayofweek) {
                    $day = $dayofweek->day;

                    if ($day == $dayfromdate) {
                        $result = $startdate->format('Y-m-d H:i:s');
                        array_push($Events, array(

                            "title" => $title,
                            "start" => $result,
                            "allday" => "true",
                            "backgroundColor" => "#343a40",
                            "textColor" => "#f7f7f7",
                            "borderColor" => "#c6c7c8",


                        ));
                    }
                }

                $startdate = $startdate->modify('+1 day');
            }
          
            return view('fullcalendar', ['Events' => $Events, 'EventData' => $event, 'dow' => $dow]);
        } else {
            $Events = array();
            $dow = array();
            $event = array(
                "dateFrom" => '',
                "dateTo" => '',

            );
       
            return view('fullcalendar', ['Events' => $Events, 'EventData' => $event, 'dow' => $dow]);
        }


       
    }


    public function store(Request $request)
    {

        $data = request()->validate([

            'Event.dateFrom' => 'required|date_format:Y-m-d',
            'Event.dateTo' =>  'required|date_format:Y-m-d',
            'Event.eventName' => 'required',
            'dow.*.day' => 'nullable'

        ]);
       
        $result = Event::where('id', 1)->first();
        if ($result) {
            //update event
            Event::truncate();
            dayOfweek::truncate();
           
        } 
        $event = Event::create($data['Event']);
          
        if (array_key_exists('dow', $data)) 
{

        $event->dayOfWeek()->createMany($data['dow']);
}
        return redirect('/');
    }



    
}
