<?php

namespace App\Transformers;

use App\Models\Attendee;
use League\Fractal\TransformerAbstract;

class AttendeeTransformer extends TransformerAbstract {

	public function transform( Attendee $attendee ) {
		return [
			'name'       => $attendee->name,
			'email'      => $attendee->email,
		];
	}

}