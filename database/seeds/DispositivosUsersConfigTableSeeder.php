<?php

use Illuminate\Database\Seeder;
use App\DispositivoUser;
use App\DispositivoUserConfig;

class DispositivosUsersConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dispositivos = DispositivoUser::all();

      foreach($dispositivos as $dispositivo){
        $dispositivo->config()->save(new DispositivoUserConfig([
          'alias' => 'Alias 1',
          'alias_1' => 'Data 1',
          'alias_2' => 'Data 2',
          'alias_3' => 'Data 3',
        ]));
      }
    }
}
