<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contáctate</title>
</head>
<body>
    <h1>Contacto para su inmueble</h1>
    <h4>Datos del contacto</h4>
    <ul>
        <li>Nombre: {{ $ad_contact->full_name }} </li>
        <li>Correo: {{ $ad_contact->email }} </li>
        <li>Telefono: {{ $ad_contact->phone }} </li>
        @if ( $ad_contact->bid_amount )
            Monto a ofrecer: {{ $ad_contact->bid_amount }}
        @endif
        <li>Mensaje: {{ $ad_contact->message }} </li>
        <li>Ruta del aviso: {{ $aviso_url }} </li>
    </ul>
</body>
</html>