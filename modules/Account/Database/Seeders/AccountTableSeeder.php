<?php

namespace Modules\Account\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Account\Entities\Account;
use Modules\Account\Entities\Movement;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 5 accounts
        factory(Account::class, 5)->create()->each(function ($a) {
            // create some account movements
            $a->movements()->saveMany(factory(Movement::class, rand(3, 10))->make());
        });
    }
}
