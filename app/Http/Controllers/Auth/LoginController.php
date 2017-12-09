<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $token = $this->guard()->attempt($this->credentials($request));

        if ($token) {
            $this->guard()->setToken($token);

            return true;
        }

        return false;
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
	protected function validateLogin(Request $request)
	{
		$this->validate($request, [
			$this->username() => [
				'required', 'string',
				Rule::exists('users')->where(function($query) {
					$query->where('active', true);
				})
			],
			'password' => 'required|string',
		], $this->validationErrors());
	}

	/**
	 * Get the validation errors for login.
	 *
	 * @return array
	 */
	protected function validationErrors(  ) {
		return  [
			$this->username() . '.exists' => 'No account found, or you need to activate your account.'
		];
	}

	/**
	 * Send the response after the user was authenticated.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        $token = (string) $this->guard()->getToken();
        $expiration = $this->guard()->getPayload()->get('exp');

        return [
            'meta' => [
	            'token' => $token,
	            'token_type' => 'bearer',
	            'expires_in' => $expiration - time(),
            ]
        ];
    }

	/**
	 * Log the user out of the application.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return void
	 */
    public function logout(Request $request)
    {
        $this->guard()->logout();
    }
}
