<x-layouts.main>
  <x-slot:title>Inicio - Liga de Cohetes</x-slot:title>
  <x-slot:css>href="<?= url('css/home.css'); ?>"</x-slot:css>


  <h1 class="display-1 fw-bold text-center text-white mb-5">Liga de Cohetes</h1>

  <div class="row g-4 align-items-stretch">
    @foreach ($products as $p)
    <div class="col-lg-6 col-md-6 col-sm-12">
      <section class="py-5 mb-5 h-100">
        <div class="hero-card bg-white rounded-4 shadow-lg overflow-hidden mx-auto hero-card-width h-100 d-flex flex-column">
          <div class="hero-image overflow-hidden hero-image-height">
            @if ($p->imageRoute !== null && \Storage::exists($p->imageRoute))
              <img src="{{ \Storage::url($p->imageRoute) }}" alt="{{ $p->imageDescription }}" class="w-100 h-100 object-fit-cover">
            @else
              <img src="{{ \Storage::url('images/logo-liga-de-cohetes.png') }}" alt="Logo de la Liga de Cohetes" class="w-100 h-100 object-fit-cover">
            @endif
          </div>
          <div class="p-5 text-center text-dark d-flex flex-column justify-content-between flex-grow-1">
            <div>
              <h2 class="display-3 fs-1 fw-bold mb-3 hero-title-color">{{ $p->title }}</h2>
              <p class="fs-4 fw-medium mb-3 hero-subtitle-color">{{ $p->subtitle }}</p>
              <p class="fs-5 lh-base mb-4 hero-description-color">
                {{ $p->content }}
              </p>
            </div>
            <div>
              <p class="fs-1 fw-bold text-primary mb-3">
                {{ number_format($p->price, 0, ',', '.') }} AR$
              </p>
              <button class="btn-primary btn btn-lg px-5 py-3 rounded-3 fw-semibold">Comprar Juego</button>
            </div>
          </div>
        </div>
      </section>
    </div>
    @endforeach
  </div>

  <section class="mb-5">
    <div class="row align-items-stretch mb-3 feature-row-height">
      <div class="col-lg-6">
        <div class="feature-image overflow-hidden rounded-4 shadow h-100 feature-image-min-height">
          <img src="{{ \Storage::url('images/season-20-liga-de-cohetes.jpg') }}" alt="Imagen de la nueva Temporada" class="w-100 h-100 object-fit-cover">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="feature-content bg-light rounded-4 shadow p-5 h-100 d-flex flex-column justify-content-center">
          <h3 class="display-5 fw-semibold mb-3 feature-title-color">Nueva Temporada</h3>
          <p class="fs-5 lh-base mb-4 feature-text-color">
            Descubre nuevos mapas, vehículos exclusivos y desafíos épicos. 
            La temporada más emocionante está aquí con recompensas increíbles 
            y competencias que pondrán a prueba tus habilidades.
          </p>
          <button class="btn-primary btn btn-lg px-4 py-3 rounded-3 fw-medium">Explorar Temporada</button>
        </div>
      </div>
    </div>

    <div class="row align-items-stretch mb-3 feature-row-height">
      <div class="col-lg-6 order-lg-2">
        <div class="feature-image overflow-hidden rounded-4 shadow h-100 feature-image-min-height">
          <img src="{{ \Storage::url('images/sonic-liga-de-cohetes.jpg') }}" alt="Calcomania de Sonic" class="w-100 h-100 object-fit-cover">
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <div class="feature-content bg-light rounded-4 shadow p-5 h-100 d-flex flex-column justify-content-center">
          <h3 class="display-5 fw-semibold mb-3 feature-title-color">Colaboración con Sonic</h3>
          <p class="fs-5 lh-base mb-4 feature-text-color">
            ¡Sonic llega a la Liga de Cohetes! Conduce el icónico vehículo azul 
            del erizo más rápido del mundo. Nuevos efectos de sonido, 
            decoraciones exclusivas y la velocidad que solo Sonic puede ofrecer.
          </p>
          <a href="{{ route('news.show', ['id' => 2]) }}" class="btn-primary btn btn-lg px-4 py-3 rounded-3 fw-medium">Ver Colaboración</a>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-section py-5 mb-4 rounded-4 text-center text-white cta-background">
    <div class="container">
      <h2 class="display-4 fw-semibold mb-3 cta-title-color">¿Listo para la Acción?</h2>
      <p class="fs-4 lh-base mb-4 mx-auto cta-text-color cta-text-width">
        Únete a millones de jugadores en todo el mundo y experimenta 
        el deporte más emocionante del futuro. ¡Descarga ahora y comienza tu leyenda!
      </p>
      <div class="d-flex gap-3 justify-content-center flex-wrap">
        <button class="btn-primary btn btn-lg px-4 py-3 rounded-3 fw-semibold">Descargar Gratis</button>
        <button class="btn-secondary btn btn-lg px-4 py-3 rounded-3 fw-semibold">Ver Trailer</button>
      </div>
    </div>
  </section>

</x-layouts.main>