<?php

namespace App\Transformers;

use App\Models\Invitee;
use League\Fractal\TransformerAbstract;

class InviteeTransformer extends TransformerAbstract {

	public function transform( Invitee $invitee ) {
		return [
			'name'       => $invitee->name,
			'email'      => $invitee->email,
		];
	}

}