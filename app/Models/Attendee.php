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
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'identifier';
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function sales() {
		return $this->hasMany(Sale::class);
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function event() {
		return $this->belongsTo(Event::class);
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


}
