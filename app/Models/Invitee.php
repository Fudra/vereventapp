<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitee extends Model
{
	protected $fillable = [
		'name',
		'email',
	];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function event() {
		return $this->belongsTo(Event::class);
	}
}
