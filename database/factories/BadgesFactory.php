<?php

use Faker\Generator as Faker;

$factory->define(App\Badges::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'description' => $faker->paragraph,
        'owner_id' => rand(1,10),
    ];
});
