<?php

use Faker\Generator as Faker;

$factory->define(App\Feedback::class, function (Faker $faker) {
    return [
        'answer_id' => factory(App\Answer::class)->create()->id,
        'evaluator_id' => factory(App\Evaluator::class)->create()->id,
        'text' => $faker->realText(),
        'grade' => $faker->numberBetween(0,4)
    ];
});
