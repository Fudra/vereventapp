<?php

namespace App\Listeners\User;

use App\Events\User\UserSendDeletingEmail;
use App\Mail\UserDeletedConfimationEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class UserSendDeletedEmail
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
	 * @param UserSendDeletingEmail $event
	 *
	 * @return void
	 */
    public function handle(UserSendDeletingEmail $event)
    {
	    Mail::to($event->email)
	        ->send(new UserDeletedConfimationEmail());
    }
}
