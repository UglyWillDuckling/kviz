<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(),
        'image' => $faker->imageUrl(),
        'video' => $faker->imageUrl(),
        'time_limit' => $faker->numberBetween(5, 20),
        'enabled' => true,
        'approved' => true,
    ];
});
