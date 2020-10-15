<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EventRepository;

class CalendarController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function month_component_list(Request $request)
    {
        // $month = isset($request->month) ?
        $month = $request->month;        
        $year = $request->year;
        $datelist = $this->create_calendar_list($month, $year);
        return $datelist;
    }

    /**
     *  create a calendar list for specific month and year 
     *  @param month : integer
     *  @param year  : integer   
     **/     
    private function create_calendar_list($month, $year)
    {
        // array of week days
        $daysOfWeek = array('S','M','T','W','T','F','S');
        // determine the first day of the month which returns integer
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);            
        // count the number of days for this month and year
        $numberOfDays = date('t', $firstDayOfMonth);        
        // convert the integer value of mktime to an array of values from date component
        $dateComponents = getdate($firstDayOfMonth);

        $data = [];

        // get the weekday code from daysOfWeek array
        $dow = $daysOfWeek[$dateComponents["wday"]];
        // initialize first day to 1
        $fday = 1;

        $eventRepo = new EventRepository;
        $month_events = $eventRepo->month_events($month, $year);

        for($i = 1; $i <= $numberOfDays; $i++) {
            $intDate = mktime(0,0,0, $month, $i, $year);
            $dComponents = getdate($intDate);
            $date = date("Y-m-d", $intDate);
            
            // initialize date row
            // $dRow = [];
            // create an array of date components
            // $dRow['month']  = $month;
            // $dRow['year']   = $year;
            // $dRow['dow']    = $dComponents["wday"]; // week day
            // $dRow['date']   = $date;
            // $dRow['day']    = $dComponents["mday"]; // month day     
            $key = $month.$year.$dComponents["mday"];            
            $data[$key] = [
                'key'   => $key,
                'month' => $month,
                'year'  => $year,
                'dow'   => $dComponents["wday"],
                'date'  => $date,
                'day'   => $dComponents["mday"],
                'event' => isset($month_events[$key]['event']) ? $month_events[$key]['event'] : ''
            ];              
        }
        
        // return the json data of the created date list of specific month and year
        return response()->json($data);
    }
}
