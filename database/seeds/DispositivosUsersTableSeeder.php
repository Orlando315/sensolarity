<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Dispositivo;

class DispositivosUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::where('role', 'user')->first();
      $dispositivo = Dispositivo::first();

      $user->dispositivos()->create(['dispositivo_id' => $dispositivo->id,'tipo' => $dispositivo->tipo, 'serial' => str_random(10)]);
    }
}
