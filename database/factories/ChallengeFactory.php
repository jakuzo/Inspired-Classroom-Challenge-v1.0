<?php

use Faker\Generator as Faker;

$factory->define(App\Challenge::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'start_date' => $faker->date('Y-m-d'),
        'end_date' => $faker->date('Y-m-d'),
        'active' => 0,
        'scenario' => $faker->randomHtml(1,1),
        'research' => $faker->randomHtml(1,1)
    ];
});
