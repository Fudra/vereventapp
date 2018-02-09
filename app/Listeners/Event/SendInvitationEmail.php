<?php

namespace App\Listeners\Event;

use App\Events\Event\UserSendInvitationEmail;
use App\Mail\InvitationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendInvitationEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	/**
	 * Handle the event.
	 *
	 * @param UserSendInvitationEmail $event
	 *
	 * @return void
	 */
    public function handle(UserSendInvitationEmail $event)
    {
	    Mail::to($event->guest['email'])
	        ->send(new InvitationEmail($event->guest, $event->user, $event->event));
    }
}
