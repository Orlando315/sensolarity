<?php

namespace App\Http\Controllers;

use App\DispositivoUser as Dispositivo;
use Illuminate\Http\Request;

class DispositivosUsersConfigController extends Controller
{
    /**
     * Mostrar las configuraciones del dispositivo por el numero de $data especifico.
     *
     * @param  \App\DispositivoUser  $dispositivo
     * @param  int  $data
     * @return \Illuminate\Http\Response
     */
    public function config(Dispositivo $dispositivo, $data)
    {
      if($dispositivo->tipo != 'M'){
        abort(404);
      }

      return view('dispositivos.modulos.config', compact('dispositivo', 'data'));
    }

    /**
     * Actualizar los dispositivos tipo M.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DispositivoUser  $dispositivo
     * @param  int  $data
     * @return \Illuminate\Http\Response
     */
    public function updateM(Request $request, Dispositivo $dispositivo, $data)
    {
      $this->validate($request, [
        'alias' => 'nullable|string|max:30',
        'min' => 'nullable|numeric|min:0|max:4096',
        'max' => 'nullable|numeric|min:0|max:4096',
        'unidad' => 'nullable|string|max:10',
        'porcentual' => 'nullable|in:on,off',
      ]);

      $dispositivo->config->{"alias_{$data}"} = $request->alias;
      $dispositivo->config->{"min_{$data}"} = $request->min;
      $dispositivo->config->{"max_{$data}"} = $request->max;
      $dispositivo->config->{"unidad_{$data}"} = $request->unidad;
      $dispositivo->config->{"porcentual_{$data}"} = ($request->porcentual == 'on');

      if($dispositivo->push()){
        return redirect()->route('dispositivos.data.config', compact('dispositivo', 'data'))->with([
          'flash_message' => 'Configuracion modificada exitosamente.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        return redirect()->route('dispositivos.data.config', compact('dispositivo', 'data'))->with([
          'flash_message' => 'Ha ocurrido un error.',
          'flash_class' => 'alert-danger',
          'flash_important' => true
          ]);
      }
    }

    /**
     * Obtener la configuracion de un Dispositivo de Tipo P y Data especifico
     *
     * @param  \App\DispositivoUser  $dispositivo
     * @param  int  $data
     * @return \Illuminate\Http\Response
     */
    public function get(Dispositivo $dispositivo, $data)
    {
      if($dispositivo->tipo != 'P'){
        abort(404);
      }

      $config = [
        'alias' => $dispositivo->config->{"alias_${data}"},
        'unidad' => $dispositivo->config->{"unidad_${data}"},
        'porcentual' => $dispositivo->config->{"porcentual_${data}"},
        'rangos' => $dispositivo->rangos()->where('data', $data)->get(),
      ];

      return response()->json($config);
    }

    /**
     * Actualizar los dispositivos tipo P.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DispositivoUser  $dispositivo
     * @param  int  $data
     * @return \Illuminate\Http\Response
     */
    public function updateP(Request $request, Dispositivo $dispositivo, $data)
    {
      $this->validate($request, [
        'alias' => 'nullable|string|max:30',
        'unidad' => 'nullable|string|max:10',
        'porcentual' => 'nullable|in:on,off',
      ]);

      $dispositivo->config->{"alias_{$data}"} = $request->alias_data;
      $dispositivo->config->{"unidad_{$data}"} = $request->unidad;
      $dispositivo->config->{"porcentual_{$data}"} = ($request->porcentual == 'on');

      if($dispositivo->push()){
        // Eliminar rangos
        $dispositivo->rangos()->whereIn('id', json_decode($request->delete))->delete();

        // Guardar rangos
        $dispositivo->saveRangos($data, json_decode($request->rangos));

        $response = [
          'alias' => $dispositivo->aliasData($data),
          'lastData' => $dispositivo->lastData($data) .' '. $dispositivo->unidad($data),
          'rangos' => $dispositivo->rangos()->where('data', $data)->get(),
        ];
      }else{
        $response = false;
      }

      return response()->json($response);
    }

    public function location(Request $request, Dispositivo $dispositivo)
    {
      $dispositivo->config->lat = $request->lat;
      $dispositivo->config->lng = $request->lng;
      $dispositivo->config->zoom = $request->zoom;

      return response()->json($dispositivo->push());
    }
}
