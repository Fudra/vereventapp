<?php

namespace App\Http\Controllers\Account;

use App\Models\Event;
use App\Transformers\StatsTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
	/**
	 * @param Event $event
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function index( Event $event, Request $request ) {
		$this->authorize( 'touch', $event );

		return fractal()
			->item( $event)
			->transformWith( new StatsTransformer() )
			->toArray();
	}
}
