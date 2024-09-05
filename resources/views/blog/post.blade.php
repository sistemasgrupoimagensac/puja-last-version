<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
</head>
<body>
  @if ($post->image)
    <img src="{{ asset('storage/' . $post->image) }}" alt="Imagen del post">
  @endif
  <h1>{{ $post->title }}</h1>
  {!! $post->content !!}  <!-- Renderiza HTML -->
  <p><strong>Publicado: </strong> {{ $post->created_at->format('d M, Y') }}</p>
  
</body>
</html>
