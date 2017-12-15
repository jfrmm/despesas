<?php

use Faker\Generator as Faker;
use Modules\Account\Entities\Account;
use Modules\User\Entities\User;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'iban' => $faker->iban('PT'),
        'owner_id' => User::all()->random()->first(),
    ];
});
