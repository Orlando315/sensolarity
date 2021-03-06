<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        UsersTableSeeder::class,
        ConfigurationsTableSeeder::class,
        DispositivosTableSeeder::class,
        DispositivosUsersTableSeeder::class,
        DispositivosUsersDataTableSeeder::class,
        DispositivosUsersConfigTableSeeder::class,
        DispositivosUsersRangosTableSeeder::class,
      ]);
    }
}
