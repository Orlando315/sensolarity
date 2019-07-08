<div class="row">
  <div class="col-12 p-1">
    <div class="card card-dispositivo m-0">
      <div class="card-body p-0">
        <div class="row m-0">

          <div class="col-md-4 p-1">
            <div id="data-alias-1" class="border rounded p-3 text-center">
              {{ $dispositivo->aliasData(1) }}
            </div>
          </div>
          <div class="col-md-4 p-1">
            <div id="data-last-1" class="border rounded p-3 text-right">
              {{ $dispositivo->lastData(1) }} {{ $dispositivo->unidad(1) }}
            </div>
          </div>
          <div class="col-md-4 p-1">
            <div class="border rounded p-3 text-center">
              <a href="{{ route('dispositivos.data.history', ['dispositivo' => $dispositivo->id, 'data' => 1]) }}" title="Ver historial">
                Historial
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="col-12 p-1">
    <div class="card card-dispositivo m-0">
      <div class="card-body p-0">
        <div class="row m-0">

          <div class="col-md-4 p-1">
            <div id="data-alias-2" class="border rounded p-3 text-center">
              {{ $dispositivo->aliasData(2) }}
            </div>
          </div>
          <div class="col-md-4 p-1">
            <div id="data-last-2" class="border rounded p-3 text-right">
              {{ $dispositivo->lastData(2) }} {{ $dispositivo->unidad(2) }}
            </div>
          </div>
          <div class="col-md-4 p-1">
            <div class="border rounded p-3 text-center">
              <a href="{{ route('dispositivos.data.history', ['dispositivo' => $dispositivo->id, 'data' => 2]) }}" title="Ver historial">
                Historial
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="col-12 p-1">
    <div class="card card-dispositivo m-0">
      <div class="card-body p-0">
        <div class="row m-0">

          <div class="col-md-4 p-1">
            <div id="data-alias-3" class="border rounded p-3 text-center">
              {{ $dispositivo->aliasData(3) }}
            </div>
          </div>
          <div class="col-md-4 p-1">
            <div id="data-last-3" class="border rounded p-3 text-right">
              {{ $dispositivo->lastData(3) }} {{ $dispositivo->unidad(3) }}
            </div>
          </div>
          <div class="col-md-4 p-1">
            <div class="border rounded p-3 text-center">
              <a href="{{ route('dispositivos.data.history', ['dispositivo' => $dispositivo->id, 'data' => 3]) }}" title="Ver historial">
                Historial
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>
