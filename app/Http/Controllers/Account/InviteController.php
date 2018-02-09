<?php

namespace App\Http\Controllers\Account;

use App\Events\Event\UserSendInvitationEmail;
use App\Models\Event;
use App\Transformers\InviteeTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InviteController extends Controller
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
			->collection( $event->invitees )
			->transformWith( new InviteeTransformer() )
			->toArray();
	}

	/**
	 * @param Event $event
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function invite(Event $event, Request $request) {
	     $this->authorize( 'touch', $event );

	     $data = $request
		     ->get('invitations');


	    foreach ($data as $i) {
		    $event->invitees()->create($i);
		    event(new UserSendInvitationEmail($i, $event->user, $event));
	    };

	    return response()->json( [ 'status' => 'event.invitation.successfully' ], 200 );
    }
}
