<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deseo la renvacion de mi Plan de Proyectos - Puja Inmobiliaria</title>
</head>
<body>
	<h3>Estimado asesor comercial: </h3>

	<p>
		El cliente le hace llegar su deseo de renovación al plan que tiene contratado con Puja Inmobiliaria en el apartado de Proyectos, debido ha esto es que se le hace llegar la presente, favor de ponerse en contacto para su atención.
	</p>

	<h5>Datos del cliente</h5>
	<p>
		Nombre: {{ $user->nombres }} {{ $user->apellidos }}
		N. documento: {{ $user->numero_documento }}
		Celular: {{ $user->celular }}
		Correo: {{ $user->email }}
	</p>
	
	<br><br>
	
	<p>Saludos,</p>
	
	<br>
	
	<p>Su equipo de Puja Inmobiliaria. </p>
  
</body>
</html>