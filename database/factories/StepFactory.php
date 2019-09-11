<?php

use Faker\Generator as Faker;

$factory->define(App\Step::class, function (Faker $faker) {
    return [
        'challenge_id' => factory(App\Challenge::class)->create()->id,
        'name' => $faker->monthName,
        'step_number' => $faker->numberBetween(1,7),
        'text' => $faker->realText()
    ];
});
