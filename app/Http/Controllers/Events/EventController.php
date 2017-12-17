<?php

namespace App\Http\Controllers\Events;

use App\Models\Event;
use App\Transformers\EventTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
	/**
	 * Display all public events.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$events = Event::isFinished()->isPublic()->isLive()->latest()->get();

		return fractal()
			->collection( $events )
			->parseIncludes(['user'])
			->transformWith( new EventTransformer() )
			->toArray();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Event $event
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( Event $event ) {
		return fractal()
			->item( $event )
			->parseIncludes(['user'])
			->transformWith( new EventTransformer() )
			->toArray();
	}
}
