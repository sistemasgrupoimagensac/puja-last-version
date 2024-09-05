<div class="col simple-card blog">
  <div class="card h-100 shadow">
    <div class="card-image-container">
      <img src="{{ asset('storage/' . $post->image) }}" class="card-image-custom" alt="Imagen del post">

    </div>
    <div class="card-body">
      <h4 class="card-title text-primary">{{ $post->title }}</h4>
      <small>
        <a href="{{ url('/blog/' . $post->slug) }}" class="btn btn-outline-secondary btn-sm mt-4">Leer más</a>
      </small>
    </div>
    <div class="card-footer text-body-secondary">
      <p class="card-text"><small class="text-body-secondary">Publicado: {{ $post->created_at->format('d M, Y') }}</small></p>
    </div>
  </div>
</div>
