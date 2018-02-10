<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {
	protected $fillable = [
		'attendee_id',
		'ticket_id',
		'price',
		'commission',
		'amount',
	];

	/**
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'identifier';
	}

	/**
	 *
	 */
	protected static function boot() {
		parent::boot();

		static::creating( function ( $event ) {
			$event->identifier = uniqid( true );
		} );
	}

	public function attendee() {
		return $this->belongsTo( Sale::class );
	}

	public function event() {
		return $this->belongsTo( Event::class );
	}

	public function ticket() {
		return $this->belongsTo(Ticket::class);
	}
}
