<?php

namespace App\Http\Controllers\Account;

use App\Events\User\UserSendDeletingEmail;
use App\Jobs\DeleteUserAccount;
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

		return fractal()
			->item( auth()->user() )
			->transformWith( new UserTransformer() )
			->toArray();
	}

	/**
	 *
	 */
	public function destroy() {

		// This dispatch do not work reliable
		// the UserSendDeletingEmail - Event does not fire..  :/
		//$this->dispatch(new DeleteUserAccount(auth()->user()));

		$user = auth()->user();
		$usersEmail = $user->email;

		foreach ($user->events()->get() as $event) {
			$event->attendees()->forceDelete();
			$event->sales()->forceDelete();
			$event->tickets()->forceDelete();
		}
		// delete Events
		$user->events()->forceDelete();

		// user delete
		$user->forceDelete();
		auth()->logout();

		// send confirmation Email
		event(new UserSendDeletingEmail($usersEmail));

		return response()->json(['status' => 'user.confirm_logout_and_delete']);
	}
}
