<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
	private $userMax = 10;

	private $currentUser = 0;


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory( App\Models\User::class, $this->userMax )
			->create()
			->each( function ( $u ) {
				$rand = random_int( 1, 10 );

				for ( $i = 0; $i <= $rand; $i ++ ) {
					$e = factory( App\Models\Event::class )->make();
					$u->events()
					  ->save( $e );

					$this->addTicketsToEvent( $e );
					$this->addInvitationsToEvent( $e );
					$this->addAttendeeToEvent($e);
				}

				$this->currentUser++;
				var_dump('User seeded: ' . $this->currentUser .'/'.  $this->userMax);

			} );
	}

	protected function addTicketsToEvent( \App\Models\Event $event ) {
		$rand = random_int( 1, 10 );

		for ( $i = 0; $i <= $rand; $i ++ ) {
			$event->tickets()->save( factory( App\Models\Ticket::class )->make() );
		}
	}

	protected function addInvitationsToEvent( \App\Models\Event $event ) {
		$rand = random_int( 5, 10 );

		for ( $i = 0; $i <= $rand; $i ++ ) {
			$event->invitees()->save( factory( App\Models\Invitee::class )->make() );
		}
	}

	protected function addAttendeeToEvent( App\Models\Event $event ) {
		$rand = random_int( 5, 20 );
		for ( $i = 0; $i <= $rand; $i ++ ) {
			$attendee = factory( App\Models\Attendee::class )->make();
			$event->attendees()->save($attendee);

			$this->addSalesToEvent($event, $attendee);
		}
	}

	protected function addSalesToEvent( \App\Models\Event $event, \App\Models\Attendee $attendee ) {
		$rand = random_int( 5, 20 );
		$tickets = $event->tickets();

		for ( $i = 0; $i <= $rand; $i ++ ) {
			$attendee->sales()->save( factory( App\Models\Sale::class )->make( [
				'event_id' => $event->id,
				'ticket_id' => $tickets->inRandomOrder()->first()->id,
			] ) );
		}
	}


}
