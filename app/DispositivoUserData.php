<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DispositivoUserData extends Model
{
    protected $table = 'dispositivos_users_data';

    protected $fillable = [
      'gateway',
      'data_1',
      'data_2',
      'data_3',
    ];

    /**
     * Divide la cadena de los datos y agrega los valores al modelo
     * @param $data  string 
     * @return void
     */
    public function fillData($data)
    {
      $regex = '/(\w)(\d*\.?\d)/i';
      $output = [];

      // Eliminar los primeros 4 caracteres que son el codigo del dispositivo
      $data = substr($data, 4);

      if(preg_match_all($regex, $data, $output)) {

        foreach ($output[1] as $key => $value){
          $index = $key + 1;

          $this->{"data_{$index}"} = $output[2][$key];
        }
      }
    }

    /**
     * Regresa el valor formateado del data dado
     * @param $data  int
     * @return string
     */
    public function data($data)
    {
      return number_format($this->{"data_{$data}"}, 0, ',', '.');
    }
}
