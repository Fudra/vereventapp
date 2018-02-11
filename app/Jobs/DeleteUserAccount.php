<?php

namespace App\Jobs;

use App\Events\User\UserSendDeletingEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteUserAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
	 * @var User
	 */
	public $user;

	/**
	 * Create a new job instance.
	 *
	 * @param $user
	 */
    public function __construct($user)
    {
	    $this->user = $user;
    }

	/**
	 * Execute the job.
	 *
	 *
	 * @return void
	 */
    public function handle()
    {
	    $usersEmail = $this->user->email;

	    foreach ($this->user->events()->get() as $event) {
		    $event->attendees()->forceDelete();
		    $event->sales()->forceDelete();
		    $event->tickets()->forceDelete();
	    }
	    // delete Events
	    $this->user->events()->forceDelete();

	    // user delete
	    $this->user->forceDelete();

	    // send confirmation Email
	    event(new UserSendDeletingEmail($usersEmail));
    }
}
