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

    /**
     * Relacion con la Configuracion del Dispositivo
     *
     * @return App\DispositivoUserConfig
     */
    public function config()
    {
      return $this->hasOne('App\DispositivoUserConfig', 'dispositivo_user_id');
    }

    /**
     * Relacion con la Data del Dispositivo
     *
     * @return App\DispositivoUserData
     */
    public function data()
    {
      return $this->hasMany('App\DispositivoUserData', 'dispositivo_user_id');
    }

    /**
     * Si el dispositivo no tiene un Alias, devolver el serial
     *
     * @return string
     */
    public function alias()
    {
      return $this->config->alias ?? $this->serial;
    }

    /**
     * Obtener el label del data especifico en la tabla de configuracion del dispositivo
     *
     * @param int  $data
     * @return string
     */
    public function aliasData($data)
    {
      return $this->config->{"alias_{$data}"} ?? "Data {$data}";
    }

    /**
     * Obtener el ultimo valor del data especifico
     *
     * @param int  $data
     * @return mixed (float | string)
     */
    public function lastData($data)
    {
      $last = $this->data->last();
      return $last ? $last->data($data) : '-';
    }

    /**
     * Obtener el valor minimo del data especifico en la tabla de configuracion del dispositivo
     *
     * @param int  $data
     * @return mixed (float | null)
     */
    public function min($data)
    {
      return $this->config->{"min_{$data}"};
    }

    /**
     * Obtener el valor maximo del data especifico en la tabla de configuracion del dispositivo
     *
     * @param int  $data
     * @return mixed (float | null)
     */
    public function max($data)
    {
      return $this->config->{"max_{$data}"};
    }

    /**
     * Obtener la unidad a mostrar del data especifico en la tabla de configuracion del dispositivo
     *
     * @param int  $data
     * @return string
     */
    public function unidad($data)
    {
      return $this->config->{"unidad_{$data}"};
    }

    /**
     * Obtener el estado de Porcentual del data especifico en la tabla de configuracion del dispositivo
     *
     * @param int  $data
     * @return bool
     */
    public function porcentual($data)
    {
      return $this->config->{"porcentual_{$data}"};
    }

    /**
     * Relacion con Rangos
     *
     * @return App\DispositivoUserRango
     */
    public function rangos()
    {
      return $this->hasMany('App\DispositivoUserRango', 'dispositivo_user_id');
    }

    /**
     * Guardar la informacion de los rangos desde el panel de edicion
     *
     * @param int  $data
     * @param array  $rangos
     * @return void
     */
    public function saveRangos($data, $rangos)
    {
      foreach ($rangos as $rangoRequest) {

        if($rangoRequest->id){
          $rango =  $this->rangos()->where('id', $rangoRequest->id)->first();

          if(!$rango){
            continue;
          }

          $idsToKeep[] = $rango->id;

          $rango->min = $rangoRequest->min;
          $rango->max = $rangoRequest->max;
          $rango->color = $rangoRequest->color;
          $rango->save();
        }else{

          // Solo se permiten 6 rangos
          if($this->rangos()->where('data', $data)->count() >= 6){
            continue;
          }

          $this->rangos()->create([
            'data' => $data,
            'min' => $rangoRequest->min,
            'max' => $rangoRequest->max,
            'color' => $rangoRequest->color,
          ]);
        }
      }
    }
}
