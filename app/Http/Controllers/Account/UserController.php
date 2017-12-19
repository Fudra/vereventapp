<?php

namespace App\Http\Controllers\Account;

use App\Transformers\UserTransformer;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	/**
	 * Display the information of the current user.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$user = auth()->user();

		return fractal()
			->item( $user )
			->transformWith( new UserTransformer() )
			->toArray();
	}
}
