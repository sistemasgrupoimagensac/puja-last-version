<div>
    <h2 class="text-lg font-bold mb-2">Planes contratados {{-- por --}} {{ $user->nombres }} {{ $user->apellidos }}</h2>
    
    @if ($user->plans->isEmpty())
        <p class="text-gray-600">Este usuario no tiene planes contratados.</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200" style="font-size: .8rem; color:black">
                    <th class="border border-gray-300 px-4 py-2">Estado</th>
                    <th class="border border-gray-300 px-4 py-2">Plan</th>
                    <th class="border border-gray-300 px-4 py-2">Precio</th>
                    <th class="border border-gray-300 px-4 py-2">Pagado</th>
                    <th class="border border-gray-300 px-4 py-2">Duración</th>
                    <th class="border border-gray-300 px-4 py-2">Ads Totales</th>
                    <th class="border border-gray-300 px-4 py-2">Ads Restantes</th>
                    <th class="border border-gray-300 px-4 py-2">Inicio</th>
                    <th class="border border-gray-300 px-4 py-2">Fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->plans as $plan)
                    <tr style="font-size: .75rem">
                        <td class="border border-gray-300 px-4 py-2">{{ ( $plan->plan_user->estado === 1 ) ? 'Activo' : 'Caducado' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $plan->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">S/. {{ number_format($plan->price, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">S/. {{ (number_format($plan->plan_user->price, 2) == 0 ) ? number_format($plan->price, 2) : number_format($plan->plan_user->price, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $plan->duration_in_days }} días</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $plan->total_ads }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <strong>Típicos:</strong> {{ $plan->plan_user->typical_ads_remaining }} <br>
                            <strong>Top:</strong> {{ $plan->plan_user->top_ads_remaining }} <br>
                            <strong>Premium:</strong> {{ $plan->plan_user->premium_ads_remaining }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($plan->plan_user->start_date)->format('d-m-Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($plan->plan_user->end_date)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
