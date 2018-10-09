<?php

use Faker\Generator as Faker;

$factory->define(App\Classes::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'short_description' => $faker->sentence,
        'owner_id' => rand(1,10),
    ];
});
