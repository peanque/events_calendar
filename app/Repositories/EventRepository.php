<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\EventWeekday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventRepository implements RepositoryInterface
{

    private $weekdays = ['S', 'M', 'T', 'W', 'TH', 'F', 'SA'];

    public function getAll()
    {
        return Event::all();
    }

    public function create($eventData)
    {

        $event              = Event::updateOrCreate(
            ['title'        => $eventData->title,
            'start_date'    => $eventData->start_date,
            'end_date'      => $eventData->end_date ]
        );        
        
        $dows               = $eventData->dow; 
        $start_date = $eventData->start_date;
        
        // loop through start date until end date
        while (strtotime($start_date) <= strtotime($eventData->end_date)) {                        
            $dow = date ("w", strtotime("+1 day", strtotime($start_date)));
            $start_date = date ("Y-m-d", strtotime("+1 day", strtotime($start_date)));            
            if(in_array($dow, $dows)) {                
                $event_week = $event->weekdays()->create([
                    'eventdate'     => $start_date,
                    'dayofweek'     => $this->weekdays[$dow],
                    'dayofweeknum'  => $dow
                ]);
            }
        }   
        return $event;
    }

    /**
     * Get a specific event from the given event id
     * @param id: integer
     * @return event: Event
     */
    public function show($id)
    {
        return Event::findOrFail($id);
    }
    
    /**
     * Get all events for the specific month and year
     * @param month: integer
     * @param year: integer
     * @return json
     */
    public function month_events($month, $year)
    {
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        // count the number of days for this month and year
        $numberOfDays = date('t', $firstDayOfMonth);  
        $date_start = date("Y-m-d", $firstDayOfMonth);
        $date_end = date("Y-m-d", strtotime($year."-".$month."-".$numberOfDays));        
        
        $events = EventWeekday::whereBetween('eventdate',[$date_start, $date_end])->get();                        
        $event_data = [];
        foreach ($events as $event) {
            $dComponents = getdate(strtotime($event->eventdate));
            // initialize date row
            
            $event_data[$month.$year.$dComponents["mday"]] = [
                'month' => $month,
                'year'  => $year,
                'dow'   => $event->dayofweeknum,
                'date'  => $event->eventdate,
                'day'   => $dComponents["mday"],
                'event' => $event->event->title
            ];                                    
        }
        
        return $event_data;
    }

    /**
     * Get the list of dates based on the given month and year
     * @param month: integer
     * @param year: integer
     * @return dates: array
     */
    private function get_dates($month, $year)
    {
        $dates = [];
        $numberOfDays = date('t', mktime(0, 0, 0, $month, 1, $year));
        for($i = 1; $i <= $numberOfDays; $i++) {
            $dates[] = date('t', mktime(0, 0, 0, $month, $i, $year));
        }

        return $dates;
    }

}