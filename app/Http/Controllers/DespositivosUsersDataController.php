<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DispositivoUserData;
use App\DispositivoUser;

class DespositivosUsersDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $dispositivo = DispositivoUser::where('serial', $request->serial)->firstOrFail();

      $data = new DispositivoUserData;

      $data->gateway = $request->gateway;
      $data->fillData($request->dato);

      $dispositivo->data()->save($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DispositivoUserData  $dispositivoUserData
     * @return \Illuminate\Http\Response
     */
    public function show(DispositivoUserData $dispositivoUserData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DispositivoUserData  $dispositivoUserData
     * @return \Illuminate\Http\Response
     */
    public function edit(DispositivoUserData $dispositivoUserData)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DispositivoUserData  $dispositivoUserData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DispositivoUserData $dispositivoUserData)
    {
      $dispositivoUserData->{$request->field} = $request->value;

      return $dispositivoUserData->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DispositivoUserData  $dispositivoUserData
     * @return \Illuminate\Http\Response
     */
    public function destroy(DispositivoUserData $dispositivoUserData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DispositivoUserData  $dispositivoUserData
     * @return \Illuminate\Http\Response
     */
    public function history(DispositivoUser $dispositivo, $data)
    {
      return view('dispositivos.history', compact('dispositivo', 'data'));
    }


    /**
     * Obtener la informacion de un $data especifico del dispositivo, entre las fechas dadas (start, end)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DispositivoUserData  $dispositivoUserData
     * @param  int  $data
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, DispositivoUser $dispositivo, $data)
    {
      return response()->json($dispositivo->getDataByDateAsArray($data, $request->start, $request->end));
    }
}
