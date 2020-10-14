<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreEventRequest;
use App\Repositories\EventRepository;

class EventController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request, EventRepository $eventRepository)
    {
        // validated with FormRequest and created/saved with the repository
        $event = $eventRepository->create($request);
        // return a json response
        return response()->json(['event' => $event, 201]);
    }

    /**
     * Display the specific event.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }
}
