<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Event::class, function (Faker $faker) {
    return [
	    'title' => $faker->sentence(3)   ,
	    'description_short' => $faker->paragraph(2),
	    'description' => $faker->paragraph(10),
	    'finished' => 1,
	    'live' => (bool)rand(0,1),
	    'private' => (bool)rand(0,1),
//	    'user_id' => function() {
//    	    return factory(\App\Models\User::class)->create()->id;
//	    }
    ];
});
