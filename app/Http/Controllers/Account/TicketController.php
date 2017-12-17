<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Event $event
	 * @param Ticket $ticket
	 * @param StoreTicketRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function store(Event $event, StoreTicketRequest $request)
    {
    	$event->tickets()->create($request->toArray());

	    return response()->json( [ 'status' => 'ticket.create.successfully' ], 200 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
