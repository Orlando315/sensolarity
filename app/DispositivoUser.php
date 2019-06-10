<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;
use App\Scopes\UserScope;

class DispositivoUser extends Pivot
{   
    protected $table = 'dispositivos_users';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
      parent::boot();

      // Solo para los usuarios normales (No admin)
      if(Auth::check() && !Auth::user()->isAdmin()){
        static::addGlobalScope(new UserScope);
      }
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function dispositivo()
    {
      return $this->belongsTo('App\Dispositivo');
    }

    public function status()
    {
      return $this->disabled_at ? '<span class="badge badge-secondary" rel="tooltip" title="Desactivo el: ' . $this->disabled_at . '">Desactivado</span>' : '<span class="badge badge-success">Activado</span>';
    }

    public function name()
    {
      return $this->dispositivo->tipo . $this->dispositivo->codigo;
    }
}
