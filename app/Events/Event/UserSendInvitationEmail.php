<?php

namespace App\Events\Event;

use App\Models\Event;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserSendInvitationEmail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


	public $user;

	public $guest;

	public $event;

	/**
	 * Create a new event instance.
	 *
	 * @param Object $guest
	 * @param User $user
	 * @param Event $event
	 */
    public function __construct($guest, User $user, Event $event) {
	    $this->guest = $guest;
	    $this->user = $user;
	    $this->event = $event;
    }

}
