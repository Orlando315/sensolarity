<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DispositivoUserConfig extends Model
{
    protected $table = 'dispositivos_users_config';

    protected $fillable = [
      'alias',
      'alias_1',
      'min_1',
      'max_1',
      'porcentual_1',
      'unidad_1',
      'alias_2',
      'min_2',
      'max_2',
      'porcentual_2',
      'unidad_2',
      'alias_3',
      'min_3',
      'max_3',
      'porcentual_3',
      'unidad_3',
    ];

    public function hasPosition()
    {
      return $this->lat && $this->lng;
    }

}
