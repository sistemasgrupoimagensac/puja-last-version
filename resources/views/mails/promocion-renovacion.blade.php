@component('mail::message')
# ¡Renueva tu plan!

Hola {{ $plan->proyectoCliente->user->nombres }},

Tu plan actual está próximo a vencer el **{{ $plan->fecha_fin->format('d/m/Y') }}**. 

¡No te quedes sin publicar tus inmuebles! Renueva tu plan por solo **S/ {{ number_format($plan->monto, 2) }}** por {{ $plan->duracion }} meses.

@component('mail::button', ['url' => route('planes.renovacion', ['plan_id' => $plan->id])])
Renovar Plan Ahora
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
