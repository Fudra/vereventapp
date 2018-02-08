<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	/**
	 * Show all available users resource.
	 *
	 * @param User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		return fractal()
			->collection( User::active()->get() )
			->transformWith( new UserTransformer() )
			->toArray();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param User $user
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( User $user ) {

		return fractal()
			->item( $user )
			->parseIncludes(['events'])
			->transformWith( new UserTransformer() )
			->toArray();
	}
}
