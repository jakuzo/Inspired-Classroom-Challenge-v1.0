<?php

use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
        'step_id' => factory(App\Step::class)->create()->id,
        'classroom_id' => factory(App\Classroom::class)->create()->id,
        'team_id' => factory(App\Team::class)->create()->id,
        'text' => $faker->realText()
    ];
});
