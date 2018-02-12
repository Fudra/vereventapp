<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Sale::class, function (Faker $faker) {
    return [
	    'price' => 0,
	    'commission' => 0,
	    'amount' => random_int(1, 10),
    ];
});
