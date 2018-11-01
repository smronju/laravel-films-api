<?php

use Faker\Generator as Faker;

$factory->define(App\Film::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'release_date' => $faker->date(),
        'rating' => $faker->numberBetween(1,5),
        'ticket_price' => $faker->randomNumber(),
        'country' => $faker->country,
        'genre' => $faker->randomElement(['Comedy','Drama','Horror','Action']),
        'photo' => $faker->image('public/images/posters',400,300, null, false)
    ];
});
