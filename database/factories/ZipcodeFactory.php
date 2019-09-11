<?php

use Faker\Generator as Faker;

$factory->define(App\Zipcode::class, function (Faker $faker) {
    return [
        'zip' => $faker->postcode,
        'city' => $faker->city,
        'state_id' => factory(App\State::class)->create()->id
    ];
});
