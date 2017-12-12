<?php

use Faker\Generator as Faker;
use Modules\Account\Entities\Movement;
use Modules\User\Entities\User;

$factory->define(Movement::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeThisMonth,
        'amount' => $faker->randomFloat(2, -100, 100),
        'description' => $faker->sentence,
        'creator_id' => User::all()->random()->first()->id,
    ];
});
