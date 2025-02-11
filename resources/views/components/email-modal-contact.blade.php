@props(['inmuebleId'])

<button 
    type="button"
    {{-- class="btn btn-primary border-secondary-subtle text-white btn-responsive d-flex align-items-center justify-content-center gap-2" --}}
    {{ $attributes->merge([
        'class' => 'btn btn-primary border-secondary-subtle text-white btn-responsive d-flex align-items-center justify-content-center gap-2'
    ]) }}
    data-bs-toggle="modal"
    data-bs-target="#emailModal-{{ $inmuebleId }}"
>
    <i class="fas fa-envelope"></i>
    <span>Email</span>
</button>

<div
    class="modal fade"
    id="emailModal-{{ $inmuebleId }}"
    tabindex="-1"
    aria-labelledby="emailModalLabel-{{ $inmuebleId }}"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel-{{ $inmuebleId }}">
                    Contáctar al propietario por correo
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>

            <div class="modal-body">
                <form id="form-email-contact-{{ $inmuebleId }}">
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
                        <label for="email-{{ $inmuebleId }}" class="form-label">Tu Email</label>
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

                    <div class="mb-3">
                        <label for="mensaje-{{ $inmuebleId }}" class="form-label">Mensaje</label>
                        <textarea
                            class="form-control"
                            id="mensaje-{{ $inmuebleId }}"
                            name="mensaje"
                            rows="4"
                            required
                        ></textarea>
                    </div>

                    <div class="form-check mb-3">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="terminos-{{ $inmuebleId }}"
                            name="terminos"
                            required
                        >
                        <label class="form-check-label" for="terminos-{{ $inmuebleId }}">
                            Acepto los <a href="#" target="_blank">Términos y Condiciones de Uso</a> y las <a href="#" target="_blank">Políticas de Privacidad</a>.
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Contactar
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("form-email-contact-{{ $inmuebleId }}");

        form.addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(form);

            fetch("{{ route('inmueble.emailContact') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const modal = document.getElementById("emailModal-{{ $inmuebleId }}");
                    const modalBS = bootstrap.Modal.getInstance(modal);
                    modalBS.hide();

                    alert("¡Correo enviado al propietario satisfactoriamente!");
                } else {
                    alert(data.message || "Ocurrió un problema al enviar el correo.");
                }
            })
            .catch(err => {
                console.error("Error al enviar el correo:", err);
                alert("Hubo un error al intentar enviar el correo.");
            });
        });
    });
</script>
