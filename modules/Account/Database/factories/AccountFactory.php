<?php

use Faker\Generator as Faker;

use Modules\Account\Entities\Account;

$factory->define(Account::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'iban' => $faker->iban('PT'),
    ];
});
