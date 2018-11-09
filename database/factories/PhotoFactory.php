<?php

use Faker\Generator as Faker;

$factory->define(App\Photo::class, function (Faker $faker) {
    return [
        'room_id' => rand(1,50),
        'user_id' => Null,
        'notification_id' => Null,
        'consumption_id' => Null,
        'name' =>  $faker->image(public_path(Config::get('assets.images')) ,500, 400, [], []),
        'type' => 1
    ];
});
