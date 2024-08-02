<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contáctate</title>
</head>
<body>
    <h1>Usted a publicado un aviso nuevo.</h1>
    <h4>Datos del aviso</h4>
    <ul>
        <li>Descripción: {{ $aviso->inmueble->descripcion }} </li>
        <br>
        <li>URL del inmueble: {{ request()->getScheme() . "://". request()->getHost() . "/inmueble/" . $aviso->link() }} </li>
    </ul>
</body>
</html>