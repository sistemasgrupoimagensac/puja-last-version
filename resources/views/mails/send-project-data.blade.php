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
        <li>Nombre: {{ $proyecto_contact->full_name }} </li>
        <li>Correo: {{ $proyecto_contact->email }} </li>
        <li>Telefono: {{ $proyecto_contact->phone }} </li>
        <li>Mensaje: {{ $proyecto_contact->message }} </li>
        <li>Horario de contacto: {{ $proyecto_contact->time }}</li>
        <li>Ruta del aviso: {{ $proyecto_url }} </li>
    </ul>
</body>
</html>