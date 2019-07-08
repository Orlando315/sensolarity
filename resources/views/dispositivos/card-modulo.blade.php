<div class="card card-dispositivo">
  <div class="card-body p-1">
    <div class="row p-2">
      <div class="col-md-4 pb-2 pb-md-0">
        <div class="border rounded p-3 text-center">
          {{ $dispositivo->aliasData(1) }}
        </div>
      </div>
      <div class="col-md-4 pb-2 pb-md-0 pl-md-2">
        <div class="border rounded p-3 text-right">
          {{ $dispositivo->lastData(1) }} {{ $dispositivo->unidad(1) }}
        </div>
      </div>
      <div class="col-md-4 pl-md-2">
        <div class="border rounded p-3 text-center">
          <a href="{{ route('dispositivos.data.history', ['dispositivo'=>$dispositivo->id, 'data'=>1]) }}" title="Ver historial">
            Historial
          </a>
        </div>
      </div>
    </div>

    <div class="row p-2">
      <div class="col-md-4 pb-2 pb-md-0">
        <div class="border rounded p-3 text-center">
          {{ $dispositivo->aliasData(2) }}
        </div>
      </div>
      <div class="col-md-4 pb-2 pb-md-0 pl-md-2">
        <div class="border rounded p-3 text-right">
          {{ $dispositivo->lastData(2) }} {{ $dispositivo->unidad(2) }}
        </div>
      </div>
      <div class="col-md-4 pl-md-2">
        <div class="border rounded p-3 text-center">
          <a href="{{ route('dispositivos.data.history', ['dispositivo'=>$dispositivo->id, 'data'=>2]) }}" title="Ver historial">
            Historial
          </a>
        </div>
      </div>
    </div>

    <div class="row p-2">
      <div class="col-md-4 pb-2 pb-md-0">
        <div class="border rounded p-3 text-center">
          {{ $dispositivo->aliasData(3) }}
        </div>
      </div>
      <div class="col-md-4 pb-2 pb-md-0 pl-md-2">
        <div class="border rounded p-3 text-right">
          {{ $dispositivo->lastData(3) }} {{ $dispositivo->unidad(3) }}
        </div>
      </div>
      <div class="col-md-4 pl-md-2">
        <div class="border rounded p-3 text-center">
          <a href="{{ route('dispositivos.data.history', ['dispositivo'=>$dispositivo->id, 'data'=>3]) }}" title="Ver historial">
            Historial
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
