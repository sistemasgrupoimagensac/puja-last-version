<header class="custom-container">

  {{-- Navbar Desktop --}}
  <div class="d-lg-block">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid p-0">
  
          <a class="navbar-brand" href="/">
            <img class="navbar-logo-puja" src="{{ asset('images/svg/logo_puja.svg') }}" alt="logo de pujainmobiliaria">
          </a>
  
          <button class="btn d-lg-none d-flex align-items-center justify-content-center p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <i class="fa-solid fa-bars icon-orange fa-xl m-3"></i>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
            </ul>

            <a class="button-orange btn mx-1" href="{{ route("sign_in", ['profile_type' => 2]) }}">Iniciar Sesión</a>
          </div>
  
        </div>
      </nav>
  </div>


</header> 

{{-- Navbar Mobile (contenido en un offcanvas) --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header d-flex justify-content-between">
    <a class="navbar-brand" href="/">
      <img class="navbar-logo-puja" src="{{ asset('images/svg/logo_puja.svg') }}" alt="logo de pujainmobiliaria">
    </a>
    <button type="button" class="btn p-0" data-bs-dismiss="offcanvas" aria-label="Close">
      <i class="fa-solid fa-xmark icon-orange fa-xl m-3"></i>
    </button>
  </div>

  {{-- Linea divisora --}}
  <hr class="m-0">

  <a class="button-orange btn m-4" href="#iniciar_sesion">Iniciar Sesión</a>

</div>
