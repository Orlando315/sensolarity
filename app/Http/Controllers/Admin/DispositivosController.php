<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Dispositivo;

class DispositivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $dispositivos = Dispositivo::all();

      return view('admin.dispositivos.index', compact('dispositivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.dispositivos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'tipo' => 'required|in:P,M',
        'codigo' => 'required|alpha_num|size:3',
        'serial' => 'required|alpha_num',
      ]);

      $dispositivo = new Dispositivo($request->all());

      if(Auth::user()->dispositivosAgregados()->save($dispositivo)){

        return redirect()->route('admin.dispositivos.show', ['dispositivo' => $dispositivo->id])->with([
          'flash_message' => 'Dispositivo agregado exitosamente.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        return redirect()->route('admin.dispositivos.create')->with([
          'flash_message' => 'Ha ocurrido un error.',
          'flash_class' => 'alert-danger',
          'flash_important' => true
          ]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function show(Dispositivo $dispositivo)
    {
      return view('admin.dispositivos.show', compact('dispositivo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Dispositivo $dispositivo)
    {
      return view('admin.dispositivos.edit', compact('dispositivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dispositivo $dispositivo)
    {
      $this->validate($request, [
        'tipo' => 'required|in:P,M',
        'codigo' => 'required|alpha_num|size:3',
        'serial' => 'required|alpha_num',
      ]);

      $dispositivo->fill($request->all());

      if($dispositivo->save()){
        return redirect()->route('admin.dispositivos.show', ['dispositivo' => $dispositivo->id])->with([
          'flash_message' => 'Dispositivo agregado exitosamente.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        return redirect()->route('admin.dispositivos.edit', ['dispositivo' => $dispositivo->id])->with([
          'flash_message' => 'Ha ocurrido un error.',
          'flash_class' => 'alert-danger',
          'flash_important' => true
          ]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dispositivo $dispositivo)
    {
      if($dispositivo->delete()){
        return redirect()->route('admin.dispositivos.index')->with([
          'flash_message' => 'Dispositivo eliminado exitosamente.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        return redirect()->route('admin.dispositivos.show', ['dispositivo' => $dispositivo->id])->with([
          'flash_message' => 'Ha ocurrido un error.',
          'flash_class' => 'alert-danger',
          'flash_important' => true
          ]);
      }
    }

    /**
     * Cambiar la disponibilidad de un Dispositivo especifico.
     *
     * @param  \App\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function disponibilidad(Dispositivo $dispositivo)
    {
      $dispositivo->disponible = !$dispositivo->disponible;

      if($dispositivo->save()){
        return redirect()->route('admin.dispositivos.show', ['dispositivo' => $dispositivo->id])->with([
          'flash_message' => 'Disponibilidad modificada exitosamente.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        return redirect()->route('admin.dispositivos.show', ['dispositivo' => $dispositivo->id])->with([
          'flash_message' => 'Ha ocurrido un error.',
          'flash_class' => 'alert-danger',
          'flash_important' => true
          ]);
      }
    }
}
