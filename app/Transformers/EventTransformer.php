<?php

namespace App\Transformers;

use App\Event;
use League\Fractal\TransformerAbstract;

class EventTransformer extends TransformerAbstract {
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
}