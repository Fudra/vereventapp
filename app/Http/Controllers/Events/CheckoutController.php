<?php

namespace App\Http\Controllers\Events;

use App\Events\Checkout\SaleCreated;
use App\Exceptions\TicketQuantityIsNotValidException;
use App\Http\Requests\Events\CheckoutRequest;
use App\Jobs\Checkout\CreateTicketSale;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\Sale;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller {
	/**
	 * @param Event $event
	 * @param CheckoutRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function checkout( Event $event, CheckoutRequest $request ) {

		$this->manageSale($event,$request->only( [ 'name', 'email', 'tickets' ] ));

		return response()->json( [ 'err' => 'err' ] );
	}

	/**
	 * @param $event
	 * @param $checkout
	 */
	protected function manageSale($event, $checkout) {

		//	dispatch(new CreateTicketSale($event, $request->only(['name', 'email', 'tickets'])));

		$attendee = new Attendee;

		$attendee->fill( [
			'identifier' => uniqid( true ),
			'name'       => $checkout['name'],
			'email'      => $checkout['email'],
		] );

		$attendee->save();

		foreach ( $checkout['tickets'] as $ticket ) {
			$t = Ticket::findByIdentifier( $ticket['ticketId'] )->first();

//			if ( $t->quantity - $ticket['amount'] < 0 ) {
			// throw new TicketQuantityIsNotValidException();
//			}

			$t->decrement( 'quantity', $ticket['amount'] );

			$sale = new Sale();
			$sale->fill( [
				'price'      => $t->price,
				'amount'     => $ticket['amount'],
				'commission' => 0,
			] );


			$sale->ticket()->associate($t);
			$sale->attendee()->associate( $attendee );
			$sale->event()->associate( $event );
			$sale->save();
		}

		event(new SaleCreated($attendee));
	}
}
