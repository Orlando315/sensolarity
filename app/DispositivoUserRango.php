<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DispositivoUserRango extends Model
{
    protected $table = 'dispositivos_users_rangos';

    protected $fillable = [
      'data',
      'min',
      'max',
      'color',
    ];
}
