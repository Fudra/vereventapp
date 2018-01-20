<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract {

	protected $availableIncludes = [
		'events'
	];

	public function transform( User $user ) {
		return [
			'identifier' => $user->identifier,
			'name'       => $user->name,
			'email'      => $user->email,
			'photo_url'  => $user->photo_url,
			'_links'     => [
				'self' => [
					'href' => route('user.show', ['idenfifier' => $user->identifier ]),
				],
			],
		];
	}

	public function includeEvents( User $user ) {
		return $this->collection($user->events, new EventTransformer());
	}
}