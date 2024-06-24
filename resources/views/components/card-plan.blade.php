<div class="card" style="width:18rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted ">Card subtitle</h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    b5
  </div>
</div>

<div class="card text-center card-plan-container">
  <div class="card-body">
    <h5 class="card-title icon-orange">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  <div class="card-footer text-body-secondary">
    2 days ago
  </div>
</div>



@push('styles')
    @vite(['resources/sass/components/card_plan.scss'])
@endpush

@push('scripts')
    @vite(['resources/js/scripts/components/card_plan.js'])
@endpush