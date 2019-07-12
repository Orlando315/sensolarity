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

    protected $casts = [
      'lat' => 'float',
      'lng' => 'float',
      'zoom' => 'integer',
      'min_1' => 'float',
      'max_1' => 'float',
      'porcentual_1' => 'boolean',
      'min_2' => 'float',
      'max_2' => 'float',
      'porcentual_2' => 'boolean',
      'min_3' => 'float',
      'max_3' => 'float',
      'porcentual_3' => 'boolean',
    ];

    public function hasPosition()
    {
      return $this->lat && $this->lng;
    }

}
