<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

	/**
	 * Determine if the given event can be touch by the user.
	 *
	 * @param \App\Models\User $user
	 * @param \App\Models\Event $event
	 *
	 * @return bool
	 */
	public function touch( User $user, Event $event ) {
		return $user->id == $event->user_id;
   }
}
