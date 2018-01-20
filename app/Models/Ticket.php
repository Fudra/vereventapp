<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'name',
		'quantity',
		'available_from',
		'available_to',
		'price',
		'visible',
	];

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = [
		'available_from',
		'available_to',
	];

	/**
	 * Determinate if the event is free
	 *
	 * @return bool
	 */
	public function isFree() {
		return $this->price == 0;
	}

	/**
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'identifier';
	}

	public function event( ) {
		return $this->belongsTo(Event::class);
	}

	/**
	 *
	 */
	protected static function boot() {
		parent::boot();

		static::creating( function ( $ticket ) {
			$ticket->identifier = uniqid( true );
		} );
	}
}
