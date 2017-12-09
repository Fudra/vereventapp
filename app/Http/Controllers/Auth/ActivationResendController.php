<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestedActivationEmail;
use App\Http\Requests\Auth\ActivationResendRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationResendController extends Controller
{
	/**
	 * @param ActivationResendRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function resend( ActivationResendRequest $request ) {

		$user = User::byEmail( $request->email )->first();

		if ( $user->active ) {
			return response()->json(['status' => 'Your account is already active.'], 403);
		}

		event( new UserRequestedActivationEmail( $user ) );
		return response()->json(['status' => 'Activation Email has been resend.'], 200);

	}
}
