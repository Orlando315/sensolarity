<?php

use Illuminate\Database\Seeder;
use App\User;

class DispositivosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $admin = User::where('role', 'admin')->first();

      $admin->dispositivosAgregados()->createMany([
        [
          'tipo' => 'P',
          'codigo' => '123',
          'serial' => 'a1b2c3d4e5',
        ],
        [
          'tipo' => 'M',
          'codigo' => '456',
          'serial' => '1a2b3c4d5e',
        ]
      ]);
    }
}
