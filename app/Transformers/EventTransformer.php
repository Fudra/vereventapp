<?php

namespace App\Transformers;

use App\Models\Event;
use League\Fractal\TransformerAbstract;

class EventTransformer extends TransformerAbstract {

	protected $availableIncludes = ['user'];

	public function transform( Event $event ) {
		return [
			'identifier'        => $event->identifier,
			'title'             => $event->title,
			'description'       => $event->description,
			'description_short' => $event->description_short,
			'price'             => $event->price,
			'live'              => boolval($event->live),
			'private'           => boolval($event->private),
		];
	}

	public function includeUser( Event $event ) {
		return $this->item($event->user, new UserTransformer());
	}
}