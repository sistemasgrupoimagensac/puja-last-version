
<div class="carousel overflow-hidden" data-flickity='{ "wrapAround": true, "autoPlay": true }'>
  @foreach($avisos as $aviso)
  <div class="carousel-cell">
    @include('components.card_simple', [
      'link' => route('inmueble.single', ['inmueble' => $aviso->link()]),
      'title' => $aviso->inmueble->title(),
      'image' => $aviso->inmueble->imagenPrincipal(),
      'type' => $aviso->inmueble->type(),
      'category' => $aviso->inmueble->category(),
      // 'currency' => $aviso->inmueble->currencySoles() ? $aviso->inmueble->currencyDolares(),
      'currency' => $aviso->inmueble->precioSoles() ? $aviso->inmueble->currencySoles() : $aviso->inmueble->currencyDolares(),
      // 'price' => $aviso->inmueble->precioSoles() ?? $aviso->inmueble->precioDolares(),
      'price' => $aviso->inmueble->precioSoles() ? $aviso->inmueble->precioSoles() : ($aviso->inmueble->precioDolares() ? $aviso->inmueble->precioDolares() : $aviso->inmueble->remate_precio_base() ),
      'address' => $aviso->inmueble->address(),
      'district' => $aviso->inmueble->distrito(),
      'department' => $aviso->inmueble->provincia(),
      'area' => $aviso->inmueble->area(),
      'bedrooms' => $aviso->inmueble->dormitorios(),
      'bathrooms' => $aviso->inmueble->banios(),
      'like' => false,
    ])
  </div>
  @endforeach
</div>