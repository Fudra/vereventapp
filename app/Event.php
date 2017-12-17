<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model {
	use SoftDeletes;

	protected $fillable = [
		'title',
		'description_short',
		'description',
		'price',
		'finished',
		'live',
		'private',
	];

	public function user() {
		return $this->belongsTo( User::class );
	}
	public function isFree() {
		return $this->price == 0;
	}

	public function scopeFinished( Builder $builder ) {
		return $builder->where( 'finished', true );
	}

	public function getRouteKeyName() {
		return 'identifier';
	}

	protected static function boot() {
		parent::boot();

		static::creating( function ( $file ) {
			$file->identifier = uniqid( true );
		} );
	}

}
