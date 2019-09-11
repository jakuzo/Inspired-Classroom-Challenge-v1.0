<?php

use Faker\Generator as Faker;

$factory->define(App\School::class, function (Faker $faker) {
    return [
        'name' => $faker->lastName,
        'address_line'=> $faker->address,
        'zipcode_id' => factory(App\Zipcode::class)->create()->id,
        'frlp' => $faker->numberBetween(0,100)
    ];
});
