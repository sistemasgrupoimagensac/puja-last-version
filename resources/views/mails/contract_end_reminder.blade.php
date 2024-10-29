<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recordatorio Puja Inmobiliaria</title>
</head>
<body>
  <h3>Estimados señores de: {{ $cliente->nombre_comercial }}</h3>

  <p>Este es un recordatorio de que su contrato con fecha de finalización <span class="fw-bold">{{ $cliente->fecha_fin_contrato }}</span> está próximo a vencerse en 30 días.</p>
  
  <p>Por favor, contacte con nosotros si desea renovar o hacer ajustes a su contrato.</p>
  
  <p>Saludos,</p>
  <p>Su equipo de {{ config('app.name') }}</p>
  
</body>
</html>