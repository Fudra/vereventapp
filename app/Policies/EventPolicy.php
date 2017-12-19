<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

	public function touch( User $user, Event $event ) {
		return $user->id == $event->user_id;
   }
}