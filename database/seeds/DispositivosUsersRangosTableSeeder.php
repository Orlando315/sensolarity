<?php

use Illuminate\Database\Seeder;
use App\DispositivoUser;
use App\DispositivoUserRango;

class DispositivosUsersRangosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dispositivo = DispositivoUser::where('tipo', 'P')->first();

      $dispositivo->rangos()->createMany([
        [
          'data' => 1,
          'min' => 0,
          'max' => 1024,
          'color' => '#ffffff',
        ],
        [
          'data' => 1,
          'min' => 1025,
          'max' => 2048,
          'color' => '#FFF728',
        ],
        [
          'data' => 2,
          'min' => 2049,
          'max' => 3072,
          'color' => '#DA0000',
        ],
        [
          'data' => 3,
          'min' => 3073,
          'max' => 4096,
          'color' => '#0038D8',
        ],
      ]);
    }
}
