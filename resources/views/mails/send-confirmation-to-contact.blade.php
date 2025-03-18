<h1>Hemos recibido tu interés del inmueble</h1>
<h4>El dueño del inmueble se pondrá en contacto con usted en la brevedad</h4>

<h5>Resumen del inmueble</h5>
<ul>
    <li>Dirección: {{ $aviso->inmueble->address() }}</li>
    <li>Distrito: {{ $aviso->inmueble->distrito() }}</li>
    <li>Provincia: {{ $aviso->inmueble->provincia() }}</li>
    <li>Precio: <span>{{ $aviso->inmueble->currencySoles() }}</span><span>{{ number_format($aviso->inmueble->precioSoles(), 0, '', ',') }}</span> | <small>{{ $aviso->inmueble->currencyDolares() }}</small><small>{{ number_format($aviso->inmueble->precioDolares(), 0, '', ',') }}</small></li>
    <li>Url: {{ $url }}</li>
</ul>

<h5>Descripción</h5><br/>
{!! $aviso->inmueble->principal->caracteristicas->descripcion !!}

<p style="margin-bottom: 0; font-weight: bold;">¡Gracias por confiar en nosotros!</p>
<p style="font-weight: bold;">El equipo de Puja Inmobiliaria</p>
