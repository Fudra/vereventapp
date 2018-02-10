<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Auth\UserRequestedActivationEmail' => [
            'App\Listeners\Auth\SendActivationEmail',
        ],
	    'Illuminate\Auth\Events\PasswordReset' => [
	    	'App\Listeners\Auth\SendPasswordChangeEmail',
	    ],
	    'App\Events\Event\UserSendInvitationEmail' => [
	    	'App\Listeners\Event\SendInvitationEmail'
	    ],
	    'App\Events\Checkout\SaleCreated' => [
	        'App\Listeners\Checkout\SendEmailToAttendee'
	    ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
