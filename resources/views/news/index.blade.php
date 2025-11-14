<?php
// @var Illuminate\Database\Eloquent\Collection $news
?>

<x-layouts.main>
  <x-slot:title>Noticias - Liga de Cohetes</x-slot:title>
  <x-slot:css>href="<?= url('css/news.css'); ?>"</x-slot:css>
  
  <div class="hero-section bg-primary text-white py-5 mb-5 rounded-3 shadow">
    <div class="container text-center">
      <h1 class="display-4 fw-bold mb-3">Cohete de noticias</h1>
      <p class="lead">Mantente al día con las últimas novedades de la Liga de Cohetes</p>
    </div>
  </div>
  
  @auth
  <div class="mb-4 d-flex justify-content-center">
    <a href="{{ route('news.create') }}" class="btn btn-primary">Crear noticia</a>
  </div>
  @endauth
  
  <div class="row g-4">
    @foreach ($news as $n)
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 shadow-sm border-0 news-card">
          <div class="card-img-top-container position-relative overflow-hidden news-image-height">
            @if ($n->image !== null && \Storage::exists($n->image))
                <img src="{{ \Storage::url($n->image) }}" alt="{{ $n->image_description }}" class="w-100 h-100 object-fit-cover">
            @else
                <p>Sin imagen</p>
            @endif
          </div>


          <div class="card-body d-flex flex-column justify-content-between">
            <span class="badge news-show-author-badge px-3 py-2 mb-2" 
              @if ($n->category) 
                  style="color: {{ $n->category->color }}" 
              @endif> 
              {{ $n->category?->category_name ?? 'Sin categoría' }}
            </span>
            <div class="d-flex justify-content-between align-items-center gap-2">
              <h2 class="card-title fw-bold text-dark mb-3">
                {{ $n->title }}
              </h2>
              <div class="d-flex gap-2">
                @auth
                  <a class="btn btn-outline-secondary btn-sm" href="{{ route('news.edit', ['id' => $n->id]) }}"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-outline-danger btn-sm" href="{{ route('news.delete', ['id' => $n->id]) }}"><i class="fas fa-trash"></i></a>
                @endauth
              </div>
            </div>

            <div class="card-footer bg-transparent border-0 px-0 pt-3">
              <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">
                  <i class="fas fa-calendar-alt me-1"></i>
                  {{ $n->created_at->format('d M Y') }}
                </small>
                
                <div class="d-flex gap-1 flex-wrap">
                  <a class="btn btn-primary btn-sm" href="{{ route('news.show', ['id' => $n->id]) }}">Ver más</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

</x-layouts.main>