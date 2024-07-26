{{-- contacto por whatsapp --}}
<button class="btn btn-light border-secondary-subtle" type="submit" id="whatsapp_contact_button">
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

        <p class="h4 text-center mt-4">Le enviamos tus datos al anunciante</p>
        <p class="h4 text-center mt-4">por medio de whatsapp</p>

      </div>

    </div>

    <button class="btn position-absolute top-0 end-0" type="button" onClick="this.parentElement.close()">
      <i class=" fa-solid fa-close fa-2x icon-orange"></i>
    </button>

  </dialog>
  {{-- Modal Contacto Whatsapp --}}
  

@push('styles')
    @vite(['resources/sass/components/whatsapp_modal_inmueble_contact.scss'])
@endpush

@push('scripts')
    @vite(['resources/js/scripts/components/whatsapp_modal_inmueble_contact.js'])
@endpush