{{-- contacto por whatsapp --}}
<button class="btn btn-light border-secondary-subtle" type="button" id="whatsapp_contact_button">
    <i class="fab fa-whatsapp"></i> WhatsApp
</button>

  {{-- Modal Contacto Whatsapp --}}
  <dialog class="whatsapp-dialog position-relative" id="whatsapp-dialog">

    <div class="row m-0 p-0">

      <div class="d-none d-md-block col p-0">
        <div class="modal-image-container">
          <img src="{{ asset('images/signin5.webp') }}" class="modal-image-custom" alt="Imagen pujando por casa">
        </div>
      </div>

      <div class="col p-4">
        <form>
          @csrf
          <div class="d-flex flex-column gap-4">

            <fieldset class="d-flex flex-column gap-2">
              <legend class="h6 m-0 p-0">¡Contáctate con el anunciante!</legend>

              <div class="form-floating">
                <input type="text" class="form-control" id="name_register" name="name_register" placeholder="Nombre" required>
                <label class="text-secondary" for="name_register" id="label_name_register">Nombre Completo</label>
              </div>

              <div class="form-floating">
                <input type="email" class="form-control" id="email_register" name="email_register" placeholder="Correo electrónico" required>
                <label class="text-secondary" for="email_register">Correo electrónico</label>
              </div>

              <div class="form-floating">
                <input type="text" class="form-control" id="name_register" name="name_register" placeholder="Nombre" required>
                <label class="text-secondary" for="name_register" id="label_name_register">Monto ofrecido</label>
              </div>


            </fieldset>


          <input class="btn button-orange w-100 fw-bold p-2" type="submit" value="Whatsapp">
          </div>
  
        </form>

      </div>

    </div>

    <button class="btn position-absolute top-0 end-0" type="button" onClick="this.parentElement.close()">
      <i class=" fa-solid fa-close fa-2x icon-orange"></i>
    </button>

  </dialog>
  {{-- Modal Contacto Whatsapp --}}

@push('styles')
    @vite(['resources/sass/components/whatsapp_modal_contact.scss'])
@endpush

@push('scripts')
    @vite(['resources/js/scripts/components/whatsapp_modal_contact.js'])
@endpush