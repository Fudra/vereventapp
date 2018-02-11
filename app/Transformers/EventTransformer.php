<?php

namespace App\Transformers;

use App\Models\Event;
use League\Fractal\TransformerAbstract;

class EventTransformer extends TransformerAbstract {

	protected $availableIncludes = [
		'user',
		'tickets',
	];

	public function transform( Event $event ) {
		return [
			'identifier'        => $event->identifier,
			'title'             => $event->title,
			'description'       => $event->description,
			'description_short' => $event->description_short,
			'meta'              => [
				'live'     => boolval( $event->live ),
				'private'  => boolval( $event->private ),
				'attendee' => $event->attendees()->count(),
				'invitees' => $event->invitees()->count(),
				'sales'    => $event->sales()->count(),
			],
			'_links'            => [
				'self' => [
					'href' => route( 'event.show', [ 'event' => $event->identifier ] ),
				]
			],
		];
	}

	public function includeUser( Event $event ) {
		return $this->item( $event->user, new UserTransformer() );
	}

	public function includeTickets( Event $events ) {
		return $this->collection( $events->tickets, new TicketTransformer() );
	}
}