<?php

namespace App\Listeners\Checkout;

use App\Events\Checkout\SaleCreated;
use App\Mail\CheckoutEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToAttendee
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
	 * @param SaleCreated $event
	 *
	 * @return void
	 */
    public function handle(SaleCreated $event)
    {
//    	dd($event->attendee->sales()->first()->ticket);
	    Mail::to($event->attendee->email)
	        ->send(new CheckoutEmail($event->attendee));
    }
}
