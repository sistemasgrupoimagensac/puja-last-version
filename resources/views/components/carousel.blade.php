
<div class="carousel overflow-hidden" data-flickity='{ "wrapAround": true, "autoPlay": true }'>
  <div class="carousel-cell">
    @include('components.card_simple', [
      'link' => '/inmueble',
      'image' => 'images/house_1.webp',
      'type' => 'Alquiler',
      'category' => 'Casa',
      'currency' => 'S/.',
      'price' => 1200,
      'address' => 'Av. Ensenada 563',
      'district' => 'Surquillo',
      'department' => 'Lima',
      'area' => 600,
      'bedrooms' => 2,
      'bathrooms' => 1,
      'like' => false,
    ])
  </div>
  <div class="carousel-cell">
    @include('components.card_simple', [
      'link' => '/inmueble',
      'image' => 'images/house_2.webp',
      'type' => 'Venta',
      'category' => 'Casa',
      'currency' => 'S/.',
      'price' => 1244000,
      'address' => 'Av. Sanchez Cerro 1453',
      'district' => 'Lince',
      'department' => 'Lima',
      'area' => 200,
      'bedrooms' => 2,
      'bathrooms' => 1,
      'like' => false,
    ])
  </div>
  <div class="carousel-cell">
    @include('components.card_simple', [
      'link' => '/inmueble',
      'image' => 'images/house_3.webp',
      'type' => 'Venta',
      'category' => 'Casa',
      'currency' => 'S/.',
      'price' => 2100000,
      'address' => 'Calle Las Flores 234',
      'district' => 'Lince',
      'department' => 'Lima',
      'area' => 600,
      'bedrooms' => 4,
      'bathrooms' => 2,
      'like' => false,
    ])
  </div>
  <div class="carousel-cell">
    @include('components.card_simple', [
      'link' => '/inmueble',
      'image' => 'images/house_4.webp',
      'type' => 'Alquiler',
      'category' => 'Casa',
      'currency' => 'S/.',
      'price' => 2550,
      'address' => 'Av. Montañas 1286',
      'district' => 'Miraflores',
      'department' => 'Lima',
      'area' => 300,
      'bedrooms' => 3,
      'bathrooms' => 1,
      'like' => false,
    ])
  </div>
  <div class="carousel-cell">
    @include('components.card_simple', [
      'link' => '/inmueble',
      'image' => 'images/house_5.webp',
      'type' => 'Venta',
      'category' => 'Casa',
      'currency' => 'S/.',
      'price' => 1400350,
      'address' => 'Calle Los Sauces 332',
      'district' => 'Breña',
      'department' => 'Lima',
      'area' => 150,
      'bedrooms' => 3,
      'bathrooms' => 2,
      'like' => false,
    ])
  </div>
</div>