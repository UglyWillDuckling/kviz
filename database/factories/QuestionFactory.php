<?php

use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph(),
        'image' => $faker->imageUrl(),
        'video' => $faker->imageUrl(),
        'time_limit' => $faker->numberBetween(10, 20),
        'type_of_answer' => 'text',
        'enabled' => true,
        'status' => 1,
    ];
});
