<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasIdentifier {

	/**
	 * @param Builder $builder
	 * @param $identifier
	 *
	 * @return Builder $builder
	 */
	public function scopeFindByIdentifier( Builder $builder, $identifier ) {
		return $builder->where('identifier', $identifier );
	}

}