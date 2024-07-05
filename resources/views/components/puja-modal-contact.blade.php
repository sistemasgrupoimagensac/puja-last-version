
  {{-- Modal Contacto Whatsapp --}}
  <dialog class="whatsapp-dialog position-relative" id="puja-dialog">

    <div class="row m-0 p-0">

      {{-- <div class="d-none d-md-block col p-0">
        <div class="modal-image-container">
          <img src="{{ asset('images/signin5.webp') }}" class="modal-image-custom" alt="Imagen pujando por casa">
        </div>
      </div>

      <div class="col p-4">
        <form action="/">
          @csrf
          <div class="d-flex flex-column gap-4">

            <fieldset class="d-flex flex-column gap-2">
              <legend class="h6 m-0 p-0">Realiza una oferta para este inmueble</legend>

              <div class="form-floating">
                <input type="text" class="form-control" id="precio_base" name="precio_base" placeholder="Precio base" disabled readonly value="{{ $monto }}">
                <label class="text-secondary" for="precio_base" id="label_precio_base">Precio base</label>
              </div>

              <div class="form-floating">
                <input type="text" class="form-control" id="monto_ofrecido" name="monto_ofrecido" placeholder="Nombre" required>
                <label class="text-secondary" for="monto_ofrecido" id="label_monto_ofrecido">Monto ofrecido</label>
              </div>


            </fieldset>


          <input class="btn button-orange w-100 fw-bold p-2" type="submit" value="Enviar">
          </div>
  
        </form>

      </div> --}}

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

    </div>

    <button class="btn position-absolute top-0 end-0" type="button" onClick="this.parentElement.close()">
      <i class=" fa-solid fa-close fa-2x icon-orange"></i>
    </button>

  </dialog>
  {{-- Modal Contacto Whatsapp --}}

@push('scripts')
    @vite(['resources/js/scripts/components/puja_modal_contact.js'])
@endpush