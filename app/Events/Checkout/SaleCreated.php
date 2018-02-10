<?php

namespace App\Events\Checkout;

use App\Models\Attendee;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SaleCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
	/**
	 * @var Attendee
	 */
	public $attendee;


	/**
	 * Create a new event instance.
	 *
	 * @param Attendee $attendee
	 */
    public function __construct(Attendee $attendee)
    {
	    $this->attendee = $attendee;
    }

}
