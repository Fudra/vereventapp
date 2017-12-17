<?php

namespace App\Transformers;

use App\Models\Ticket;
use League\Fractal\TransformerAbstract;

class TicketTransformer extends TransformerAbstract {
	public function transform( Ticket $ticket ) {
		return [
			'name'           => $ticket->name,
			'quantity'       => $ticket->quantity,
			'available_from' => is_null($ticket->available_from) ? 'No Date' : $ticket->available_from->toDateTimeString(),
			'available_to'   => is_null($ticket->available_to) ? 'No Data' : $ticket->available_to->toDateTimeString(),
			'price'          => $ticket->price,
			'visible'        => boolval( $ticket->visible),
		];
	}
}