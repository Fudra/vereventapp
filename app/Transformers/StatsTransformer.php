<?php

namespace App\Transformers;

use App\Models\Event;
use League\Fractal\TransformerAbstract;

class StatsTransformer extends TransformerAbstract {

	public function transform( Event $event ) {
		return [
			'invited' => $event->invitees()->count(),
			'attendees' => $event->attendees()->count(),
			'sales' => $event->sales()->count()
		];
	}

}