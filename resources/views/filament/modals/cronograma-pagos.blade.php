<table class="table table-dark table-striped">

    <thead>
        <tr>
        <th>#</th>
        <th>Fecha Programada</th>
        <th>Monto</th>
        <th>Estado</th>
        <th>Intentos</th>
        <th>Último Intento</th>
        <th>Razón del Fallo</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($cronogramaPagos as $pago)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $pago->fecha_programada->format('d/m/Y') }}</td>
                <td>S/ {{ number_format($pago->monto, 2) }}</td>
                <td>{{ $pago->estadoPago->nombre ?? 'N/A' }}</td>
                <td>{{ $pago->intentos }}</td>
                <td>{{ $pago->fecha_ultimo_intento ? $pago->fecha_ultimo_intento->format('d/m/Y') : 'N/A' }}</td>
                <td>{{ $pago->razon_fallo ?? 'N/A' }}</td>
            </tr>
        @empty
            <tr>
                <th scope="row">1</th>
                <td colspan="6">No hay pagos registrados</td>
            </tr>
        @endforelse
    </tbody>

</table>

<style>
    .table th, .table td {
        text-align: center; /* Centramos el contenido de las columnas */
        vertical-align: middle; /* Centramos verticalmente */
    }
</style>