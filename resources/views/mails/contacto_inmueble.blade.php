{{-- resources/views/emails/contacto_inmueble.blade.php --}}
<h1>¡Tienes un nuevo contacto!</h1>

<p><strong>Inmueble ID:</strong> {{ $inmuebleId }}</p>
<p><strong>Nombre:</strong> {{ $nombreRemitente }}</p>
<p><strong>Email:</strong> {{ $emailRemitente }}</p>
<p><strong>Teléfono:</strong> {{ $telefono }}</p>

<hr>

<p>
    <strong>Mensaje:</strong><br>
    {{ $mensaje }}
</p>
