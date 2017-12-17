<?php

namespace App\Http\Controllers\Account;

use App\Models\Event;
use App\Http\Requests\Events\StoreEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use App\Transformers\EventTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller {
	/**
	 * Display a listing of the resource for the current user.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$events = auth()->user()->events()->latest()->isFinished()->get();

		return fractal()
			->collection( $events )
			->parseIncludes(['tickets'])
			->transformWith( new EventTransformer() )
			->toArray();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param Event $event
	 *
	 * @return Event
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function create( Event $event ) {
		if ( ! $event->exists ) {
			$event = $this->createAndReturnSkeletonEvent();

			return fractal()
				->item( $event )
				->transformWith( new EventTransformer() )
				->toArray();
		}

		$this->authorize( 'touch', $event );

		return fractal()
			->item( $event )
			->transformWith( new EventTransformer() )
			->toArray();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Event $event
	 * @param StoreEventRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function store( Event $event, StoreEventRequest $request ) {
		$this->authorize( 'touch', $event );

		$event->fill( $request->only( [
			'title',
			'description',
			'description_short',
			'live',
			'private'
		]));

		$event->finished = true;
		$event->save();

		return response()->json( [ 'status' => 'event.create.successfully' ], 200 );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Event $event
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function edit( Event $event ) {
		$this->authorize( 'touch', $event);

		return fractal()
			->item( $event )
			->transformWith( new EventTransformer() )
			->toArray();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Event $event
	 * @param UpdateEventRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function update( Event $event, UpdateEventRequest $request ) {
		$this->authorize( 'touch', $event);

		$event->update($request->only( [
			'title',
			'description',
			'description_short',
			'live',
			'private'
		]));

		return response()->json( [ 'status' => 'event.create.successfully' ], 200 );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Event $event
	 *
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function destroy( Event $event ) {
		$this->authorize( 'touch', $event);
		$event->delete();

		return response()->json( [ 'status' => 'event.create.deleted' ], 200 );
	}

	/**
	 * Create and return a event skeleton file
	 *
	 * @return Event
	 */
	protected function createAndReturnSkeletonEvent() {
		return auth()->user()->events()->create( [
			'title'             => 'Untitled',
			'description'       => 'None',
			'description_short' => 'None',
			'finished'          => false,
			'live'              => false,
			'private'           => true,
		] );
	}
}
