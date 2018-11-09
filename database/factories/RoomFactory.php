<?php

use Faker\Generator as Faker;

$factory->define(App\Room::class, function (Faker $faker) {
    return [
        //
        'user_id' => 1,
        'name' => str_random(10),
        'rent_fee' => rand(5000,150000),
        'allow_number' =>rand(1,3),
        'present_number' => 0,
        'floor' => '1',
        'width' => rand(15,30),
        'type' => rand(1,3),
        'inside_toilet' => true,
        'description' => $faker->word(20),
        'exact_place' => $faker->address,
        'status' => '0',

    ];
});
