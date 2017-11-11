<?php

namespace Modules\Account\Database\Seeders;

use Illuminate\Database\Seeder;

class AccountDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccountTableSeeder::class);
    }
}
