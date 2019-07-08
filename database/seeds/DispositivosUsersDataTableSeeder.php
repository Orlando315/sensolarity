<?php

use Illuminate\Database\Seeder;
use App\DispositivoUser;
use App\DispositivoUserData;

class DispositivosUsersDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dispositivos = DispositivoUser::all();

      foreach ($dispositivos as $dispositivo) {

        for ($i = 10; $i > 1; $i--){
          $dispositivo->data()->save(new DispositivoUserData([
            'gateway' => 'Gateway1',
            'data_1'  => rand(0, 4048),
            'data_2'  => rand(0, 4048),
            'data_3'  => rand(0, 4048),
            'created_at' =>  date('Y-m-d', strtotime("-${i} days"))
          ]));
        }
      }
    }
}
