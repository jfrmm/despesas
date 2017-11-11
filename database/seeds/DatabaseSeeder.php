<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Account\Database\Seeders\AccountDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(AccountDatabaseSeeder::class);

        Model::reguard();
    }
}
