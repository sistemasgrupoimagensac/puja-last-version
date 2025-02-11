@props(['inmuebleId'])

<button 
    type="button" 
    {{-- class="btn btn-success text-white btn-responsive d-flex align-items-center justify-content-center gap-2"  --}}
    {{ $attributes->merge([
        'class' => 'btn btn-success text-white btn-responsive d-flex align-items-center justify-content-center gap-2'
    ]) }}
    data-bs-toggle="modal" 
    data-bs-target="#whatsappModal-{{ $inmuebleId }}"
>
    <i class="fab fa-whatsapp"></i>
    <span>WhatsApp</span>
</button>

<div 
    class="modal fade" 
    id="whatsappModal-{{ $inmuebleId }}" 
    tabindex="-1" 
    aria-labelledby="whatsappModalLabel-{{ $inmuebleId }}" 
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="whatsappModalLabel-{{ $inmuebleId }}">
                    Escribe un mensaje al anunciante por este inmueble
                </h5>
                <button 
                    type="button" 
                    class="btn-close" 
                    data-bs-dismiss="modal" 
                    aria-label="Close"
                ></button>
            </div>

            <div class="modal-body">
                <form id="form-whatsapp-contact-{{ $inmuebleId }}">
                    @csrf
                    <input type="hidden" name="inmueble_id" value="{{ $inmuebleId }}">

                    <div class="mb-3">
                        <label for="nombre-{{ $inmuebleId }}" class="form-label">Nombre</label>
                        <input 
                            type="text" 
                            class="form-control"
                            id="nombre-{{ $inmuebleId }}"
                            name="nombre"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="email-{{ $inmuebleId }}" class="form-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="email-{{ $inmuebleId }}" 
                            name="email" 
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="telefono-{{ $inmuebleId }}" class="form-label">Teléfono</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="telefono-{{ $inmuebleId }}" 
                            name="telefono"
                            required
                        >
                    </div>

                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            id="terminos-{{ $inmuebleId }}" 
                            name="terminos"
                            required
                        >
                        <label 
                            class="form-check-label" 
                            for="terminos-{{ $inmuebleId }}"
                        >
                            Acepto los 
                            <a href="#" target="_blank">Términos y Condiciones de Uso</a> 
                            y las 
                            <a href="#" target="_blank">Políticas de Privacidad</a>.
                        </label>
                    </div>

                    <div class="form-check mb-4">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            id="infoAdicional-{{ $inmuebleId }}" 
                            name="info_adicional"
                        >
                        <label 
                            class="form-check-label" 
                            for="infoAdicional-{{ $inmuebleId }}"
                        >
                            Autorizo el uso de mi información para fines adicionales
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Iniciar chat
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("form-whatsapp-contact-{{ $inmuebleId }}");

        form.addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(form);

            fetch("{{ route('inmueble.whatsappContact') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la respuesta del servidor");
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    window.open(`https://wa.me/+51${data.phone}?text=${encodeURIComponent(data.whatsappMessage)}`, "_blank");

                    const modal = document.getElementById("whatsappModal-{{ $inmuebleId }}");
                    const modalBS = bootstrap.Modal.getInstance(modal);
                    modalBS.hide();
                } else {
                    alert(data.message || "Ocurrió un problema al procesar la solicitud.");
                }
            })
            .catch(error => {
                console.error("Error fetch:", error);
                alert("Hubo un error al intentar contactar vía WhatsApp.");
            });
        });
    });
</script>
