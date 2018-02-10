<?php

namespace App\Mail;

use App\Models\Attendee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckoutEmail extends Mailable //implements ShouldQueue
{
    use Queueable, SerializesModels;
	/**
	 * @var Attendee
	 */
	public $attendee;

	/**
	 * Create a new message instance.
	 *
	 * @param Attendee $attendee
	 */
    public function __construct(Attendee $attendee)
    {
	    $this->attendee = $attendee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.event.checkout');
    }
}
