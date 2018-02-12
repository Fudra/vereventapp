<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Ticket::class, function (Faker $faker) {
    return [
	    'name' => $faker->sentence(),
	    'quantity' => random_int(0, 100),
	    'available_from' => now(),
	    'available_to' => now(),
	    'price' => 0,
	    'visible' => (bool)rand(0, 1),
    ];
});
