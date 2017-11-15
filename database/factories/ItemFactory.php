<?php

use Faker\Generator as Faker;

use Baucells\Items\Models\Item;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->text
    ];
});
