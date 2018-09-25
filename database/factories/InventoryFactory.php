<?php

use Faker\Generator as Faker;

$factory->define(App\Inventory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'short_description' => $faker->sentence,
        'image' => $faker->image,
        'owner_id' => 1,
    ];
});
