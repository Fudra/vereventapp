<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Models\Event;
use App\Models\Ticket;
use App\Transformers\TicketTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Event $event
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
	 * Show the form for editing the specified resource.
	 *
	 * @param Event $event
	 * @param Ticket $ticket
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function edit(Event $event, Ticket $ticket)
    {
	    $this->authorize( 'touch', $ticket);

	    return fractal()
		    ->item( $ticket )
		    ->transformWith( new TicketTransformer() )
		    ->toArray();
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Event $event
	 * @param Ticket $ticket
	 * @param UpdateTicketRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function update(Event $event, Ticket $ticket, UpdateTicketRequest $request)
    {
	    $this->authorize( 'touch', $ticket);

	    $ticket->update($request->toArray());

	    return response()->json( [ 'status' => 'ticket.update.successfully' ], 200 );
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Event $event
	 * @param Ticket $ticket
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function destroy(Event $event, Ticket $ticket)
    {
	    $this->authorize( 'touch', $ticket);
	    $ticket->delete();

	    return response()->json( [ 'status' => 'ticket.create.deleted' ], 200 );
    }
}
