<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetResponse($response)
    {
	    return response()->json(['status' => trans($response)]);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['email' => trans($response)], 400);
    }

	/**
	 * Reset the given user's password.
	 *
	 * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
	 * @param  string $password
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function resetPassword($user, $password) {
		$user->password = bcrypt( $password );
		$user->setRememberToken( str_random( 60 ) );
		$user->save();

//		if($user->active) {
		event( new PasswordReset( $user ) );

		return response()->json( [ 'status' => trans( 'password.reset' ) ], 200 );
//			$this->guard()->login($user);
//		}
	}
}
