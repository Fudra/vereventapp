<?php

namespace App\Http\Controllers\Events;

use App\Event;
use App\Transformers\EventTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$events = auth()->user()->events()->latest()->finisiged()->get();
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
			$event = $this->createAndReturnSkeletonFile();

			return fractal()
				->item($event)
				->transformWith(new EventTransformer())
				->toArray();
		}

		$this->authorize( 'touch', $event );

		return fractal()
			->item($event)
			->transformWith(new EventTransformer())
			->toArray();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}

	/**
	 * Create and return a event skeleton file
	 *
	 * @return Event
	 */
	protected function createAndReturnSkeletonFile() {
		return auth()->user()->events()->create( [
			'title'             => 'Untitled',
			'description'       => 'None',
			'description_short' => 'None',
			'price'             => 0,
			'finished'          => false,
			'live'              => false,
			'private'           => true,
		] );
	}
}
