<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
	//use SoftDeletes;

	protected $fillable = [
		'sale_price',
		'sale_commission',
	];

	/**
	 * @return string
	 */
	public function getRouteKeyName() {
		return 'identifier';
	}

	/**
	 * Generate unique id for this entry
	 */
	protected static function boot() {
		parent::boot();

		static::creating( function ( $user ) {
			$user->identifier = uniqid( true );
		} );
	}
}
