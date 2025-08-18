@component('mail::message')
# ¡Bienvenido, {{ $user->nombres }}!

Hemos creado tu cuenta en nuestra plataforma PujaInmobiliaria.

**Correo:** {{ $user->email }}  
**Contraseña temporal:** {{ $plainPassword }}

@component('mail::button', ['url' => $loginUrl])
Iniciar sesión
@endcomponent

> Por seguridad, cambia tu contraseña después de iniciar sesión.

Gracias,  
{{ config('app.name') }}
@endcomponent