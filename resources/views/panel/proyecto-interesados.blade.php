@extends('layouts.app')

@section('title')
    Interesados
@endsection

@section('header')
    @include('components.header')
@endsection

@section('content')
<main class="main-misavisos custom-container my-5">
    <div class="container-fluid p-0 d-flex">
        @include('components.menu-panel-proyecto')
        <section class="col px-lg-5 pt-2">
            <h1>Lista de interesados</h1>

            <div class="my-5">
                {{-- Tabla de lista de interesados --}}
                <table class="table table-striped shadow">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Mensaje</th>
                            <th>Cuando</th>
                            <th>Fecha</th>
                            <th>¿Contactado?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($interesados as $interesado)
                            <tr id="row-{{ $interesado->id }}">
                                <td class="{{ $interesado->status == 1 ? 'bg-success-subtle text-success' : '' }}">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="{{ $interesado->status == 1 ? 'bg-success-subtle text-success' : '' }}">{{ $interesado->full_name }}</td>
                                <td class="{{ $interesado->status == 1 ? 'bg-success-subtle text-success' : '' }}">{{ $interesado->email }}</td>
                                <td class="{{ $interesado->status == 1 ? 'bg-success-subtle text-success' : '' }}">{{ $interesado->phone }}</td>
                                <td class="{{ $interesado->status == 1 ? 'bg-success-subtle text-success' : '' }}">{{ $interesado->message }}</td>
                                <td class="{{ $interesado->status == 1 ? 'bg-success-subtle text-success' : '' }}">{{ $interesado->time }}</td>
                                <td class="{{ $interesado->status == 1 ? 'bg-success-subtle text-success' : '' }}">{{ $interesado->created_at->format('d/m/Y') }}</td>
                                <td class="{{ $interesado->status == 1 ? 'bg-success-subtle text-success' : '' }}">
                                    <input type="checkbox" class="status-toggle form-check-input" data-id="{{ $interesado->id }}" {{ $interesado->status == 1 ? 'checked' : '' }}>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No hay interesados en este momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.status-toggle');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const contactId = this.getAttribute('data-id');
                const status = this.checked ? 1 : 0;

                fetch('{{ route('interesados.update-status') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: contactId,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        const row = document.getElementById(`row-${contactId}`);
                        const tds = row.querySelectorAll('td');

                        // Aplicar estilos a cada <td> en función del estado del checkbox
                        tds.forEach(td => {
                            if (status == 1) {
                                td.classList.add('bg-success-subtle', 'text-success');
                            } else {
                                td.classList.remove('bg-success-subtle', 'text-success');
                            }
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
@endpush
