<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Dispositivo;
use App\DispositivoUser;
use App\DispositivoUserConfig;

class DispositivosUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $dispositivos = Auth::user()->dispositivos;

      return view('dispositivos.index', compact('dispositivos'));
    }

    /**
     * Muestra todos los dispositivos de Tipo M.
     *
     * @return \Illuminate\Http\Response
     */
    public function modulos()
    {
      $dispositivos = Auth::user()->dispositivos()->where('tipo', 'M')->get();

      return view('dispositivos.modulos.index', compact('dispositivos'));
    }

    /**
     * Muestra todos los dispositivos de Tipo P.
     *
     * @return \Illuminate\Http\Response
     */
    public function mapaIndex()
    {
      $dispositivos = Auth::user()->dispositivos()->where('tipo', 'P')->get();

      return view('dispositivos.mapa.index', compact('dispositivos'));
    }

    /**
     * Muestra un dispositivo de Tipo P especifico.
     *
     * @param  \App\DispositivoUser  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function mapaShow(DispositivoUser $dispositivo)
    {
      if($dispositivo->tipo != 'P'){
        abort(404);
      }

      return view('dispositivos.mapa.show', compact('dispositivo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dispositivos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $dispositivo = Dispositivo::where([
                            ['tipo', $request->tipo],
                            ['codigo', $request->codigo],
                            ['disponible', true]
                          ])
                          ->firstOrFail();

      $this->validate($request, [
        'alias' => 'nullable|string|max:30',
        'serial' => 'required|alpha_num|max:50',
      ]);

      $dispositivoUser = new DispositivoUser([
                          'dispositivo_id' => $dispositivo->id,
                          'tipo' => $dispositivo->tipo,
                          'serial' => $request->serial,
                        ]);

      if(Auth::user()->dispositivos()->save($dispositivoUser)){
        $dispositivoUser->config()->save(new DispositivoUserConfig(['alias' => $request->alias]));

        $route = $dispositivoUser->tipo == 'M' ? 'dispositivos.modulos.index' : 'dispositivos.mapa.index';

        return redirect()->route($route)->with([
          'flash_message' => 'Dispositivo agregado exitosamente.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        return redirect()->route('dispositivos.create')->with([
          'flash_message' => 'Ha ocurrido un error.',
          'flash_class' => 'alert-danger',
          'flash_important' => true
          ]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DispositivoUser  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function show(DispositivoUser $dispositivo)
    {
      return view('dispositivos.show', compact('dispositivo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DispositivoUser  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function edit(DispositivoUser $dispositivo)
    {
      return view('dispositivos.edit', compact('dispositivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DispositivoUser  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DispositivoUser $dispositivo)
    {
      $this->validate($request, [
        'alias' => 'nullable|string|max:30',
        'serial' => 'required|alpha_num|max:50',
      ]);

      $dispositivo->serial = $request->serial;
      $dispositivo->config->alias = $request->alias;

      $route = $dispositivo->tipo == 'M' ? 'dispositivos.modulos.index' : 'dispositivos.mapa.index';

      if($dispositivo->push()){
        return redirect()->route($route)->with([
          'flash_message' => 'Dispositivo modificado exitosamente.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        return redirect()->route('dispositivos.edit', ['dispositivo' => $dispositivo->id])->with([
          'flash_message' => 'Ha ocurrido un error.',
          'flash_class' => 'alert-danger',
          'flash_important' => true
          ]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DispositivoUser  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(DispositivoUser $dispositivo)
    {
      if($dispositivo->delete()){
        $route = Auth::user()->isAdmin()
                    ? route('admin.users.show', ['user' => $dispositivo->user_id])
                    : ($dispositivo->tipo == 'M'
                      ? route('dispositivos.modulos.index')
                      : route('dispositivos.mapa.index'));

        return redirect($route)->with([
          'flash_message' => 'Dispositivo eliminado exitosamente.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        $route = Auth::user()->isAdmin()
                    ? route('dispositivos.show', ['dispositivo' => $dispositivo->id])
                    : ($dispositivo->tipo == 'M'
                      ? route('dispositivos.modulos.index')
                      : route('dispositivos.mapa.index'));

        return redirect($route)->with([
          'flash_message' => 'Ha ocurrido un error.',
          'flash_class' => 'alert-danger',
          'flash_important' => true
          ]);
      }
    }

    /**
     * Activar/Desactivar un Dispositivo especifico.
     *
     * @param  \App\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function status(DispositivoUser $dispositivo)
    {
      if(!Auth::user()->isAdmin()){
        return redirect('dashboard');
      }

      $dispositivo->disabled_at = $dispositivo->disabled_at ? null : date('Y-m-d');

      if($dispositivo->save()){
        return redirect()->route('dispositivos.show', ['dispositivo' => $dispositivo->id])->with([
          'flash_message' => 'Estado modificado exitosamente.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        return redirect()->route('dispositivos.show', ['dispositivo' => $dispositivo->id])->with([
          'flash_message' => 'Ha ocurrido un error.',
          'flash_class' => 'alert-danger',
          'flash_important' => true
          ]);
      }
    }

    /**
     * Evaluar si un dispositivo existe y esta disponible.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkIfExist(Request $request)
    {
      $exists = Dispositivo::where([
                            ['tipo', $request->tipo],
                            ['codigo', $request->codigo],
                            ['disponible', true]
                          ])
                          ->exists();

      return response()->json($exists);
    }
}
