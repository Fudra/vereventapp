<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

	public function touch( User $user, Ticket $ticket ) {
		return $user->id == $ticket->event->user_id;
	}
}
