<x-filament-panels::page>
    {{-- <h1 class="text-2xl font-bold">Bienvenido a Mi Página</h1>
    <p>Esta es una página personalizada en Filament 3.2.</p> --}}
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
            Anular Boleta
        </button>
    </form>
</x-filament-panels::page>
