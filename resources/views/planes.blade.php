@extends('layouts.app')

@section('title')
	Planes de Pago
@endsection

@push('styles')
  	@vite(['resources/sass/pages/planes.scss', 'resources/sass/components/card_plan.scss', 'resources/sass/components/flipping.scss'])
@endpush

@section('header')
    @include('components.header', ['tienePlanes' => $tienePlanes])
@endsection

<style>

/* .ribbon {
  font-size: 28px;
  font-weight: bold;
  color: #fff;
}
.ribbon {
  --s: 1.8em;
  --d: .8em;
  --c: .8em;
  
  padding: 0 calc(var(--s) + .5em) var(--d);
  line-height: 1.8;
  background:
    conic-gradient(at left  var(--s) bottom var(--d),
     #0000 25%,#0008 0 37.5%,#0004 0) 0   /50% 100% no-repeat,
    conic-gradient(at right var(--s) bottom var(--d),
     #0004 62.5%,#0008 0 75%,#0000 0) 100%/50% 100% no-repeat;
  clip-path: polygon(0 var(--d), var(--s) var(--d),var(--s) 0,calc(100% - var(--s)) 0,calc(100% - var(--s)) var(--d),100% var(--d),calc(100% - var(--c)) calc(50% + var(--d)/2),100% 100%,calc(100% - var(--s) - var(--d)) 100%,calc(100% - var(--s) - var(--d)) calc(100% - var(--d)),calc(var(--s) + var(--d)) calc(100% - var(--d)),calc(var(--s) + var(--d)) 100%,0 100%,var(--c) calc(50% + var(--d)/2));
  background-color: blue;
  width: fit-content;
  transform: rotate(-45deg);
} */



/* Ribbon base */
.ribbona {
  --s: 1.8em; /* Tamaño base de la cinta */
  --d: 0; /* Profundidad */
  --c: 0.8em; /* Parte recortada */
  
  position: absolute;  /* Permite ubicarla en la esquina */
  top: 0;              /* Anclar arriba */
  left: 0;             /* Anclar izquierda */
  z-index: 9999;       /* Para que quede por encima de otros elementos */
  
  font-size: 1.2rem;   /* Ajusta a tu gusto */
  font-weight: bold;
  color: #fff;
  
  /* Ribbon “diagonal” con transform */
  transform: rotate(-45deg) translate(-25%, 0); 
  /* El translate(-25%, 0) ayuda a centrar mejor la cinta en la esquina;
     juega con esos valores para ajustarla a tu gusto. */

  /* Propiedades originales */
  padding: 0 calc(var(--s) + .5em) var(--d);
  line-height: 1.8;
  background:
    conic-gradient(at left  var(--s) bottom var(--d),
     #0000 25%, #0008 0 37.5%, #0004 0) 0 / 50% 100% no-repeat,
    conic-gradient(at right var(--s) bottom var(--d),
     #0004 62.5%,#0008 0 75%, #0000 0) 100%/50% 100% no-repeat;
  clip-path: polygon(
    0 var(--d), var(--s) var(--d), var(--s) 0,
    calc(100% - var(--s)) 0, calc(100% - var(--s)) var(--d),
    100% var(--d), calc(100% - var(--c)) calc(50% + var(--d)/2),
    100% 100%, calc(100% - var(--s) - var(--d)) 100%,
    calc(100% - var(--s) - var(--d)) calc(100% - var(--d)),
    calc(var(--s) + var(--d)) calc(100% - var(--d)),
    calc(var(--s) + var(--d)) 100%, 0 100%, var(--c) calc(50% + var(--d)/2)
  );
  background-color: blue; /* color principal de la cinta */
  width: fit-content;
}

/* .ribbon {
  font-size: 28px;
  font-weight: bold;
  color: #fff;
}
.ribbon {
  --s: 1.8em;
  --d: 0;
  --c: .8em;
  
  padding: var(--d) calc(var(--s) + .5em) 0;
  line-height: 1.8;
  background:
    conic-gradient(from  45deg at left  var(--s) top var(--d),
     #0008 12.5%,#0000 0 37.5%,#0004 0) 0   /50% 100% no-repeat,
    conic-gradient(from -45deg at right var(--s) top var(--d),
     #0004 62.5%,#0000 0 87.5%,#0008 0) 100%/50% 100% no-repeat;
  clip-path: polygon(0 0,calc(var(--s) + var(--d)) 0,calc(var(--s) + var(--d)) var(--d),calc(100% - var(--s) - var(--d)) var(--d),calc(100% - var(--s) - var(--d)) 0,100% 0, calc(100% - var(--c)) calc(50% - var(--d)/2),100% calc(100% - var(--d)),calc(100% - var(--s)) calc(100% - var(--d)),calc(100% - var(--s)) 100%,var(--s) 100%,var(--s) calc(100% - var(--d)),0 calc(100% - var(--d)),var(--c) calc(50% - var(--d)/2));
  background-color: blue;
  width: fit-content;
  transform: rotate(-45deg) translate(-25%, 0); 
} */


/* HTML: <div class="ribbon">Your text content</div> */
.ribbon {
	font-size: 28px;
	font-weight: bold;
	color: #fff;
	top: -25px !important;
}
.ribbon {
	--s: .8em; /* the ribbon size */
	--d: .1em;  /* the depth */
	--c: .8em;  /* the cutout part */
	
	padding: var(--d) calc(var(--s) + .5em) 0;
	line-height: 1.8;
	background:
		conic-gradient(from  45deg at left  var(--s) top var(--d),
		#0008 12.5%,#0000 0 37.5%,#0004 0) 0   /50% 100% no-repeat,
		conic-gradient(from -45deg at right var(--s) top var(--d),
		#0004 62.5%,#0000 0 87.5%,#0008 0) 100%/50% 100% no-repeat;
	clip-path: polygon(0 0,calc(var(--s) + var(--d)) 0,calc(var(--s) + var(--d)) var(--d),calc(100% - var(--s) - var(--d)) var(--d),calc(100% - var(--s) - var(--d)) 0,100% 0, calc(100% - var(--c)) calc(50% - var(--d)/2),100% calc(100% - var(--d)),calc(100% - var(--s)) calc(100% - var(--d)),calc(100% - var(--s)) 100%,var(--s) 100%,var(--s) calc(100% - var(--d)),0 calc(100% - var(--d)),var(--c) calc(50% - var(--d)/2));
	background-color: #0092ec; /* the main color */
	width: fit-content;
	transform: rotate(-45deg) translate(-25%, 0); 
}


</style>

@section('content')

	<div id="loader-overlay">
		<div class="flipping"></div>
	</div>

	<div class="container my-5" x-data="pricingData()">
		<x-completa-registro-google></x-completa-registro-google>

		<h1 class="text-center fw-bold h2">¿cuantos inmuebles quieres publicar?</h1>

		{{-- SWITCH PAQUETES MIXTOS O TOP --}}
		<div class="text-center mt-5 mb-3">
			<div class="btn-group btn-group-lg" role="group" aria-label="Basic radio toggle button group">
				<input type="radio" class="btn-check" name="btnradio" id="mixtoCheck" autocomplete="off" checked @click="categoriaPlan = 'mixto'" />
				<label class="btn btn-outline-dark" for="mixtoCheck">Planes Mixtos</label>

				<input type="radio" class="btn-check" name="btnradio" id="topCheck" autocomplete="off" @click="categoriaPlan = 'top'" />
				<label class="btn btn-outline-dark" for="topCheck">Planes Exclusivos</label>
			</div>
		</div>

		<form>
			@csrf
			<div class="d-flex flex-column align-items-center py-3 gap-5" x-data="consultaDocumento()">
				<!-- número de avisos del plan -->
				<fieldset>
					<legend class="text-secondary h6 mb-3">1. Selecciona el número de avisos.</legend>
					
					<div x-show=" categoriaPlan === 'top' ">
						<div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4" x-data="{ open: false }">
							<div>
								<input type="radio" class="btn-check" id="1avisotop" value="1" autocomplete="off" x-model="numAvisos" />
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="1avisotop">1 Aviso</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="3avisotop" value="3" autocomplete="off" x-model="numAvisos" />
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="3avisotop">3 Avisos</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="5avisotop" value="5" autocomplete="off" x-model="numAvisos" />
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="5avisotop">5 Avisos</label>
							</div> 
						</div>
					</div>

					<div x-show=" categoriaPlan === 'mixto' ">
						<div role="group" class="planes-numero-avisos justify-content-center d-flex flex-wrap w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4" x-data="{ open: false }">
							<div>
								<input type="radio" class="btn-check" id="5avisos" value="5" autocomplete="off" x-model="numAvisos">
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="5avisos">5 Avisos</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="10avisos" value="10" autocomplete="off" x-model="numAvisos">
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="10avisos">10 Avisos</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="25avisos" value="25" autocomplete="off" x-model="numAvisos">
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="25avisos">25 Avisos</label>
							</div> 
							<div x-show="open" x-transition.duration.200ms>
								<input type="radio" class="btn-check" id="50avisos" value="50" autocomplete="off" x-model="numAvisos">
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="50avisos">50 Avisos</label>
							</div>
							<div x-show="open" x-transition.duration.200ms>
								<input type="radio" class="btn-check" id="75avisos" value="75" autocomplete="off" x-model="numAvisos">
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="75avisos">75 Avisos</label>
							</div>
							<div x-show="open" x-transition.duration.200ms>
								<input type="radio" class="btn-check" id="100avisos" value="100" autocomplete="off" x-model="numAvisos">
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="100avisos">100 Avisos</label>
							</div>
							<div x-show="open" x-transition.duration.200ms>
								<input type="radio" class="btn-check" id="200avisos" value="200" autocomplete="off" x-model="numAvisos">
								<label class="btn btn-lg btn-outline-secondary button-filter fs-3 px-0 py-2" for="200avisos">200 Avisos</label>
							</div>
					
							<div class="avisos-desplegar d-flex align-items-center justify-content-center icon-orange border rounded" x-on:click="open = ! open">
								<p class="m-0" x-show="!open">mostrar más</p>
								<p class="m-0" x-show="open">mostrar menos.</p>
							</div>
						</div>
					</div>
				</fieldset>

				{{-- duración del plan --}}
				<fieldset>
					<legend class="h6 text-secondary mb-3">2. Elige el tiempo de duración.</legend>
					{{-- PAQUETES TOP - duración --}}
					<div x-show=" categoriaPlan === 'top' ">
						<div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4">
							<div>
								<input type="radio" class="btn-check" id="30top" value="30" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="30top">30 días</label>
							</div>
							{{-- <div>
								<input type="radio" class="btn-check" id="60top" value="60" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="60top">60 días</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="90top" value="90" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="90top">90 días</label>
							</div> --}}
						</div>
					</div>

					{{-- PAQUETES MIXTOS - duración --}}
					<div x-show=" categoriaPlan === 'mixto' ">
						<div role="group" class="planes-numero-avisos d-flex flex-column flex-md-row justify-content-center align-items-center w-100 gap-3 gap-lg-4 px-1 p-lg-0 mt-4">
							<div>
								<input type="radio" class="btn-check" id="30mix" value="30" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="30mix">30 días</label>
							</div>
							{{-- <div>
								<input type="radio" class="btn-check" id="90mix" value="90" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="90mix">90 días</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="180mix" value="180" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="180mix">180 días</label>
							</div>
							<div>
								<input type="radio" class="btn-check" id="365mix" value="365" autocomplete="off" x-model="periodoPlan">
								<label class="btn btn-lg btn-outline-secondary fs-4 px-0 py-1" for="365mix">365 días</label>
							</div> --}}
						</div>
					</div>
				</fieldset>

				<!-- categoria de plan -->
				<fieldset>
					<legend class="text-secondary text-left h6 mb-3">3. Selecciona el mejor paquete para ti.</legend>
					
					{{-- <div role="group" class="d-flex flex-column align-items-center flex-md-row gap-4 mt-4 w-100"> --}}
					{{-- <div role="group" class="row row-cols-1 row-cols-md-3 g-4 d-flex align-items-stretch mt-4 w-100"> --}}
					<div 
						role="group"
						class="row
						row-cols-1 
						row-cols-sm-2 
						g-4
						align-items-stretch
    					justify-content-center
						mt-4
						w-100
						cards-group_promo"
						:class="class_cards"
					>

						<template x-for="plan in planes" :key="plan.id">
							<div class="col">
								<input 
									type="radio" 
									class="btn-check" 
									x-model="planId" 
									:id="`plan-${plan.id}`" 
									:value="plan.id"
									@click="selectPlan(plan.id)"
								>

								<template x-if="plan.name === 'Promoción de Lanzamiento'">
									<label
									class="card btn btn-lg p-0 card-plan-label rounded-4 h-100 position-relative button-orange text-white"
									style="overflow: visible;"
									:for="`plan-${plan.id}`"
									>
										<div class="ribbon">Gratis</div>

										<div class="card-body d-flex flex-column align-items-center {{-- p-4 --}}">
											<h4 class="card-title fw-bolder mt-3 text-left" x-text="plan.name"></h4>
											<span class="text-center mt-2 fs-6">Publica tus avisos gratis hasta el 30 de abril 2025.</span>
											<span class="fw-bold fs-6 text-center mt-2">
												<span x-text="plan.typical_ads"></span> Avisos Típicos por 
												<span x-text="plan.duration_in_days"></span> días.
											</span>
										</div>

										<div class="card-footer fw-bold fs-5 text-center text-orange rounded-bottom">
											Publicar Gratis.
										</div>
									</label>
								</template>

								<template x-if="plan.name !== 'Promoción de Lanzamiento'">
								<label
									class="card btn btn-lg p-0 card-plan-label rounded-4 h-100"
									{{-- :class="plan.class_name" --}}
									:class="plan.class_name ? plan.class_name : 'button-orange'"
									:for="`plan-${plan.id}`"
								>

									<div class="card-body d-flex flex-column p-0">
										<h3 class="card-title fw-bolder mt-3" x-text="plan.name"></h3>

										<template x-if="plan.promotion && plan.promotion2">
											<div>
												<h4 class="card-subtitle mb-2">
													S/ <span x-text="
														formatPrice(
															plan.price * (1 - plan.promotion.percentage / 100) * (1 - plan.promotion2.percentage / 100)
														)
													"></span>
													por <span x-text="plan.duration_in_days"></span> días
												</h4>
												<h6 class="fw-bolder">
													Descuento especial: <span x-text="plan.promotion.percentage"></span>%
													<br>
													Descuento adicional: <span x-text="plan.promotion2.percentage"></span>%
												</h6>
												<h6 class="card-subtitle mb-2">
													Precio regular: S/ <span x-text="formatPrice(plan.price)"></span>
												</h6>
											</div>
										</template>

										<template x-if="plan.promotion && !plan.promotion2">
											<div style="display:flex; flex-direction: column; justify-content: flex-end;">
												<h4 class="card-subtitle mb-2">
													S/ <span x-text="
														formatPrice(
															plan.price * (1 - plan.promotion.percentage / 100)
														)
													"></span>
													por <span x-text="plan.duration_in_days"></span> días
												</h4>
												<h6 class="fw-bolder">
													Descuento especial: <span x-text="plan.promotion.percentage"></span>%
												</h6>
												<h6 class="card-subtitle mb-2">
													Precio regular: S/ <span x-text="formatPrice(plan.price)"></span>
												</h6>
											</div>
										</template>

										<template x-if="!plan.promotion && plan.promotion2">
											<div>
												<h4 class="card-subtitle mb-2">
													S/ <span x-text="
														formatPrice(
															plan.price * (1 - plan.promotion2.percentage / 100)
														)
													"></span>
													por <span x-text="plan.duration_in_days"></span> días
												</h4>
												<h6 class="fw-bolder">
													Descuento especial: <span x-text="plan.promotion2.percentage"></span>%
												</h6>
												<h6 class="card-subtitle mb-2">
													Precio regular: S/ <span x-text="formatPrice(plan.price)"></span>
												</h6>
											</div>
										</template>

										<template x-if="!plan.promotion && !plan.promotion2">
											<div>
												<h4 class="card-subtitle mb-2">
													S/ <span x-text="formatPrice(plan.price)"></span>
													por <span x-text="plan.duration_in_days"></span> días
												</h4>
											</div>
										</template>

									</div>
									<hr>
									<div class="card-description-plan d-flex justify-content-start px-4">
										<ul class="list-unstyled text-start h6 mb-4">
											<li>
												<span x-text="plan.typical_ads"></span><span> avisos típicos</span>
											</li>
											<li>
												<span x-text="plan.top_ads"></span><span> avisos top</span>
											</li>
											<li>
												<span x-text="plan.premium_ads"></span><span> avisos premium</span>
											</li>
										</ul>
									</div>
									<div class="card-footer fw-bold fs-5">
										¡Lo quiero!
									</div>

								</label>
								</template>
							</div>
						</template>

					</div>

				</fieldset>

				{{-- Modal de Pago --}}
				@isset($user)
					<x-pay-modal
						avisoId="null"
						userName="{{ $user->nombres }}"
						userSurname="{{ $user->apellidos }}"
						userEmail="{{ $user->email }}"
						userPhone="{{ $user->celular }}"
						userTypeId="{{ $user->tipo_usuario_id }}"
					>
						<x-card-plan-checkout
							showPlan="Promoción de Lanzamiento"
							title="Promoción de Lanzamiento"
							bgColor="button-orange"
						/>

						<x-card-plan-checkout
						showPlan="Plan Estandar"
						title="Plan Estandar"
						bgColor="text-bg-dark"
						/>

						<x-card-plan-checkout
						showPlan="Plan VIP"
						title="Plan VIP"
						bgColor="text-bg-warning"
						/>
		
						<x-card-plan-checkout
						showPlan="Plan Premium"
						title="Plan Premium"
						bgColor="text-bg-success"
						/>
					</x-pay-modal>
				@endisset
				
			</div>    
		</form>
	</div>


	<script>

		const $loaderOverlay = document.getElementById('loader-overlay');
		window.showModal = @json($show_modal);
		window.sesionIniciada = {{ $sesion_iniciada ? 'true' : 'false' }};

		function pricingData() {
			return {
				
				planes: [],
				categoriaPlan: 'mixto',
				numAvisos: 5,
				periodoPlan: 30,
				planId: null,
				prices: 0,
				tipoDeAviso: null,
				tipoPlan: 'Plan Estandar',
				pagoFree: false,
				class_cards: 3,

				fetchPlanes() {
					$loaderOverlay.style.display = 'flex';
					document.body.style.pointerEvents = 'none';

					const datos = {
						package: this.categoriaPlan,
						total_ads: this.numAvisos,
						duration_in_days: this.periodoPlan,
					}

					this.loading = true;
					this.error = '';

					fetch('{{ route("get_planes") }}', {
						method: 'POST',
						headers: {
							'Accept': 'application/json',
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						},
						body: JSON.stringify(datos)
					})
					.then( response => response.json() )
					.then( data => {

						this.loading = false;
						if(data.status === 'Success') {
							this.planes = data.data;
							const screenWidth = window.innerWidth;
							if (this.planes.length === 4 && screenWidth >= 768 && screenWidth <= 990) {
								this.class_cards = "row-cols-md-2";
							} else {
								this.class_cards = "row-cols-md-" + this.planes.length;
							}
						} else {
							this.error = data.message || 'Error al obtener los planes.';
						}
						
					})
					.catch(error => {
						this.loading = false;
						this.error = 'Error: ' + error.message;
					})
					.finally(() => {
						$loaderOverlay.style.display = 'none';
						document.body.style.pointerEvents = 'auto';
					});

				},

				getPlan() {
					$loaderOverlay.style.display = 'flex';
					document.body.style.pointerEvents = 'none';

					const datos = {
						plan_id: this.planId,
					}

					fetch('{{ route("get_plan") }}', {
						method: 'POST',
						headers: {
							'Accept': 'application/json',
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						},
						body: JSON.stringify(datos)
					})
					.then( response => response.json() )
					.then( data => {
						if (data.data.promotion !== null && data.data.promotion2 !== null ) {
							this.prices = data.data.price
								* (1 - data.data.promotion.percentage / 100)
								* (1 - data.data.promotion2.percentage / 100);
						} else if (data.data.promotion && !data.data.promotion2) {
							this.prices = data.data.price
								* (1 - data.data.promotion.percentage / 100);
						} else if (!data.data.promotion && data.data.promotion2) {
							this.prices = data.data.price
								* (1 - data.data.promotion2.percentage / 100);
						} else {
							this.prices = data.data.price;
						}
						this.prices = this.formatPrice(this.prices)
						this.tipoPlan = data.data.name
						if ( this.tipoPlan === "Plan Estandar" || this.tipoPlan === "Promoción de Lanzamiento" ) {
							this.tipoDeAviso = 1
						} else if ( this.tipoPlan === "Plan VIP" ) {
							this.tipoDeAviso = 2
						} else if ( this.tipoPlan === "Plan Premium" ) {
							this.tipoDeAviso = 3
						}
						if ( this.planId >= 118 && this.planId <= 123 ) {
							this.pagoFree = true
						} else {
							this.pagoFree = false
						}						
					})
					.catch(error => {
						console.error('Error:', error.message)
					})
					.finally(() => {
						$loaderOverlay.style.display = 'none';
						document.body.style.pointerEvents = 'auto';
					});
				},

				selectPlan(planId) {
					this.planId = planId;

					if (!window.sesionIniciada) {
						window.location.href = "{{ route('sign_in', ['profile_type' => 3]) }}";
						return;
					}

					this.getPlan();
					const modalPago = new bootstrap.Modal('#modalPago');
					modalPago.show();
				},

				debounceFetch() {
					clearTimeout(this._fetchTimer);
					this._fetchTimer = setTimeout(() => {
						this.fetchPlanes();
					}, 300);
				},

				formatPrice(price) {
					return Number(price).toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
				},

				init() {

					window.addEventListener('resize', () => this.fetchPlanes());
					this.debounceFetch();

					this.$watch('numAvisos', () => {
						this.debounceFetch();
					})
					this.$watch('periodoPlan', () => {
						this.debounceFetch();
					})
					this.$watch('tipoPlan', () => {
						this.debounceFetch();
					})
					this.$watch('categoriaPlan', () => {
						this.debounceFetch();
					})
				},
			}
		}

		document.addEventListener('alpine:init', () => {
			Alpine.store('creditCardData', creditCardData());
			Alpine.data('pricingData', pricingData);
		});

	</script>

@endsection

@section('footer')
	<x-footer></x-footer>
@endsection

@push('scripts')
  	@vite([ 'resources/js/scripts/planes.js' ])
@endpush
  
@push('scripts-head')  
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="https://js.openpay.pe/openpay.v1.min.js"></script>
	<script src="https://js.openpay.pe/openpay-data.v1.min.js"></script>
@endpush
