<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvitationEmail extends Mailable {
	use Queueable, SerializesModels;

	public $user;

	public $guest;

	public $event;

	/**
	 * Create a new message instance.
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

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->markdown( 'emails.event.invite' );
	}
}
