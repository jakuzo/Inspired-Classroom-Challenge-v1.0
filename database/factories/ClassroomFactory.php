<?php

use Faker\Generator as Faker;

$factory->define(App\Classroom::class, function (Faker $faker) {
    return [
        'join_code' => $faker->uuid,
        'name' => $faker->monthName,
        'challenge_id' => factory(App\Challenge::class)->create()->id,
        'teacher_id' => factory(App\Teacher::class)->create()->id,
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'num_students' => $faker->numberBetween(10, 30),
        'num_teams' => $faker->numberBetween(2, 5)
    ];
});
