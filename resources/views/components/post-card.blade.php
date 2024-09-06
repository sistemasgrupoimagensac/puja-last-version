<div class="post-card-container col simple-card blog my-4">
  <div class="card h-100 shadow">
    <div class="card-image-container">
      <img src="{{ asset('storage/' . $post->image) }}" class="card-image-custom" alt="Imagen del post">

    </div>
    <div class="card-body">
      <a href="{{ url('/blog/' . $post->slug) }}" class="post-card-title card-title h4 text-decoration-none d-block" target="blank">{{ $post->title }}</a>
      <div>
        <a href="{{ url('/blog/' . $post->slug) }}" class="btn btn-outline-secondary btn-sm mt-4" target="blank">Leer más</a>
      </div>
    </div>
    <div class="card-footer text-body-secondary">
      <p class="card-text"><small class="text-body-secondary">Publicado: {{ $post->created_at->format('d M, Y') }}</small></p>
    </div>
  </div>
</div>
