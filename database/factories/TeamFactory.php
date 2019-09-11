<?php

use Faker\Generator as Faker;

$factory->define(App\Team::class, function (Faker $faker) {
    return [
        'classroom_id' => factory(App\Classroom::class)->create()->id,
        'name' => $faker->colorName
    ];
});
