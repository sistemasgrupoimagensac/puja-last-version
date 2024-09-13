<footer class="footer-container py-4">
  <div class="container d-flex flex-column flex-md-row justify-content-md-between position-relative">

    <div class="d-flex flex-column my-4">
      <img src={{ asset('images/svg/logoblanco_puja.svg') }} class="footer-img-logo" alt="logo de pujainmobiliaria del footer">  
    </div>

    <div class="d-flex flex-column text-center m-2 my-4">
      <h4 class="mb-3">Menú</h4>
      <a class="footer-link-puja" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Alquiler')]) }}">Alquiler</a>
      <a class="footer-link-puja" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Venta')]) }}">Compra</a>
      <a class="footer-link-puja" href="{{ route('busqueda_inmuebles', ['operacion' => Str::slug('Propiedades en Remate')]) }}">Remate</a>
      <a class="footer-link-puja" href="/politica-privacidad" target="blank">Politicas de Privacidad</a>
      <a class="footer-link-puja" href="/terminos-uso" target="blank">Terminos y Condiciones de Uso</a>
    </div>

    <div class="d-flex flex-column text-center m-2 my-4">
      <h4 class="mb-3">Anunciantes</h4>
      <a class="footer-link-puja" href="">Agencias</a>
      <a class="footer-link-puja" href="">Agentes</a>
      <a class="footer-link-puja" href="">Corredores</a>
      <a class="footer-link-puja" href="">Constructores</a>
    </div>

    <div class="d-flex flex-column text-center m-2 my-4">
      <h4 class="mb-3">Contáctanos</h4>
      <p class="p-0 m-0">Av. Canaval y Moreyra 290</p>
      <p class="p-0 m-0">Oficina No 41 y 42</p>
      <p class="p-0 m-0">Cuarto Piso, San Isidro</p>
      <p class="p-0 m-0">consulta@pujainmobiliaria.com.pe</p>
      <p class="p-0 m-0">(01) 4036709</p>
      <p class="p-0 m-0">+51 934 339 375</p>
    </div>

    <div class="d-flex flex-column text-center m-2 my-4">

      <h4 class="mb-3">Síguenos</h4>
      <div class=" fs-1 mb-3">
          <a class="text-decoration-none" href="https://www.facebook.com/pujainmobiliaria" target="_blank">
            <i class="fa-brands fa-facebook-f text-center icon m-auto p-2 icon-white"></i>
          </a>
          <a class="text-decoration-none" href="https://www.instagram.com/pujainmobiliaria/" target="_blank">
            <i class="fa-brands fa-instagram text-center icon m-auto p-2 icon-white"></i>
          </a>
      </div>
      <div class="d-flex flex-column">
        <a class="text-decoration-none" target="_blank" href="{{ route('libro_reclamaciones') }}">
          <i class="fs-1 fa-solid fa-book-open icon-white"></i>
          <p class="m-0 text-white">Libro de reclamaciones</p>
        </a>
      </div>
    </div>

  </div>
  <div class="d-flex justify-content-center">
    <small class="m-0 ms-4 position-absolute">
      &#169 <span id="currentYear"></span>
      <a class="footer-link-puja" href="https://grupoimagensac.com.pe/" target="blank"> Grupo Inmobiliario Imagen SAC </a>
      <i><img src="{{ asset('images/svg/peru.svg') }}" alt="bandera Perú" style="width: 20px;"></i>
    </small>
  </div>
</footer>

@push('styles')
    @vite(['resources/sass/components/footer.scss'])
@endpush

@push('scripts')
    @vite([ 'resources/js/scripts/components/footer.js' ])
@endpush
