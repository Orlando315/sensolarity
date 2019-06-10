<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'tipo', 'codigo', 'serial', 'deshabilitado'
    ];

    /**
     * Relacion al usuario que lo agrego al sistema
     *
     * @var array
     */
    public function admin()
    {
      return $this->belongsTo('App\User');
    }

    /**
     * Relacion al usuario que lo agrego al sistema
     *
     * @var array
     */
    public function user()
    {
      return $this->belongsToMany('App\User', 'dispositivos_users')->using('App\DispositivoUser')->withPivot(['id', 'serial','disabled_at']);
    }

    public function tipo()
    {
      return $this->tipo == 'P' ? 'Valor en mapa (P)' : 'Modulo (M)';
    }

    public function disponible()
    {
      return $this->disponible ? '<span class="badge badge-success">Sí</span>' : '<span class="badge badge-secondary">No</span>';
    }
}
