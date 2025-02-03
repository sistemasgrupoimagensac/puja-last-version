<div class="mt-4">
	<div id="" class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-between">
	@foreach($avisos_nuevos as $aviso)
		{{-- <div class="col">  --}}
		@include('components.card_nuevos', [
			'link' => route('inmueble.single', ['inmueble' => $aviso->link()]),
			'title' => $aviso->inmueble->title(),
			'image' => $aviso->inmueble->imagenPrincipal(),
			'type' => $aviso->inmueble->type(),
			'category' => $aviso->inmueble->category(),
			'currency' => $aviso->inmueble->precioSoles() ? $aviso->inmueble->currencySoles() : $aviso->inmueble->currencyDolares(),
			'price' => $aviso->inmueble->precioSoles() ? $aviso->inmueble->precioSoles() : ($aviso->inmueble->precioDolares() ? $aviso->inmueble->precioDolares() : $aviso->inmueble->remate_precio_base() ),
			'address' => $aviso->inmueble->address(),
			'district' => $aviso->inmueble->distrito(),
			'department' => $aviso->inmueble->provincia(),
			'area' => $aviso->inmueble->area(),
			'bedrooms' => $aviso->inmueble->dormitorios(),
			'bathrooms' => $aviso->inmueble->banios(),
			'like' => false,
		])
		{{-- </div> --}}
	@endforeach
	</div>
</div>