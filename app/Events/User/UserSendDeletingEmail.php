<?php

namespace App\Events\User;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserSendDeletingEmail implements ShouldQueue
{
    use Dispatchable, SerializesModels;
	/**
	 * @var string
	 */
	public $email;

	/**
	 * Create a new event instance.
	 *
	 * @param string $email
	 */
    public function __construct(string $email)
    {
	    $this->email = $email;
    }
}
