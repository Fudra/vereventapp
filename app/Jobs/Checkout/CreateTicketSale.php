<?php

namespace App\Jobs\Checkout;

use App\Exceptions\TicketQuantityIsNotValidException;
use App\Models\Attendee;
use App\Models\Sale;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateTicketSale implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $checkout;

	public $event;

	/**
	 * Create a new job instance.
	 *
	 * @param $event
	 * @param $checkout
	 */
	public function __construct( $event, $checkout ) {
		$this->event = $event;
		$this->checkout = $checkout;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 * @throws TicketQuantityIsNotValidException
	 */
	public function handle() {
		$attendee = new Attendee;

		$attendee->fill( [
			'identifier' => uniqid( true ),
			'name'       => $this->checkout['name'],
			'email'      => $this->checkout['email'],
		] );

		$attendee->save();

		foreach ( $this->checkout['tickets'] as $sale ) {
			$ticket = Ticket::findByIdentifier( $sale['ticketId'] )->first();

//			if ( $ticket->quantity - $sale['amount'] < 0 ) {
//				throw new TicketQuantityIsNotValidException();
//			}

			$ticket->decrement( 'quantity', $sale['amount'] );

			$sale = new Sale();
			$sale->fill( [
				'price'      => $ticket->price,
				'amount'     => $sale['amount'],
				'commission' => 0,
			] );

			$sale->save();
			$sale->attendee()->associate( $attendee );
			$sale->event()->associate( $this->event );
			$sale->save();
		}

		// send Email
		// event(new SendSaleConfirmation())

	}

	/**
	 * Get the tags that should be assigned to the job.
	 *
	 * @return array
	 */
	public function tags()
	{
		return ['CreateTicketSale'];
	}
}
