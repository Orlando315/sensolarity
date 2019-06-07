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

    public function user()
    {
      return $this->belongsTo('App\User');
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
