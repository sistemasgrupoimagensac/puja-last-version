<div>
  <p><strong>Transacción:</strong>
    @if ($record->status === 1)
      <span style="color: green;">Exitosa</span>
    @else
      <span style="color: red;">Fallida</span>
    @endif
  </p>
  <br/>
  <hr>
  <br/>

  {{-- Datos Cliente --}}
  <p><strong>Nombre del Cliente:</strong> {{ $record->customer_name }}</p>
  <p><strong>Correo del Cliente:</strong> {{ $record->customer_email }}</p>
  <p><strong>Tipo de Cliente:</strong>
    @if ($record->tipo_usuario_id === 2)
      Propietario
    @elseif ($record->tipo_usuario_id === 3)
      Corredor Inmobiliario
    @elseif ($record->tipo_usuario_id === 4)
      Acreedor Hipotecario
    @elseif ($record->tipo_usuario_id === 5)
      Proyecto Inmobiliario
    @endif
  </p>

  <br/>
  <hr>
  <br/>
  
  {{-- Datos Transacción --}}
  <p><strong>Fecha Transacción:</strong> {{ $record->creation_date }}</p>
  <p><strong>Moneda:</strong> {{ $record->currency }}</p>
  <p><strong>Monto:</strong> {{ number_format($record->amount, 2) }}</p>
  <p><strong>Descripción:</strong> {{ $record->description }}</p>

  <br/>
  <hr>
  <br/>
  
  @if ( isset($record->error_code) )
    <p><strong>Error:</strong> {{ $record->error_description }}</p>
    <p><strong>Código del error:</strong> {{ $record->error_code }}</p>
    <p><strong>Request ID:</strong> {{ $record->request_id }}</p>
  @else
    <p><strong>Código del Banco:</strong> {{ $record->card_bank_code }}</p>
    <p><strong>Nombre del Banco:</strong> {{ $record->card_bank_name }}</p>
    <p><strong>Usuario Tarjeta:</strong> {{ $record->card_holder_name }}</p>
    <p><strong>Tipo de Tarjeta:</strong> {{ $record->card_type }}</p>
  @endif
  
</div>
