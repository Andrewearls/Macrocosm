<?php

use Faker\Generator as Faker;

$factory->define(App\Inventory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'short_description' => $faker->sentence,
        'image' => "https://picsum.photos/200/200",
        'owner_id' => rand(1,10),
        'price' => rand(0,1000),
    ];
});
