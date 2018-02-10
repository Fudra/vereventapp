<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
	//use SoftDeletes;

	protected $fillable = [
		'name',
		'email',
	];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
//	protected $table = 'attendees';


	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'identifier';
	}

	/**
	 * Generate unique id for this entry
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot() {
		parent::boot();

		static::creating( function ( $attendee ) {
			$attendee->identifier = uniqid( true );
		} );
	}

	public function sales() {
		return $this->hasMany(Sale::class);
	}

}
