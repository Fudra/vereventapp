<?php

namespace App\Http\Controllers\Events;

use App\Models\Event;
use App\Transformers\TicketTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
	/**
	 * Display the specified resource.
	 *
	 * @param Event $event
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( Event $event ) {
		return fractal()
			->collection( $event->tickets )
			->transformWith( new TicketTransformer() )
			->toArray();
	}
}
