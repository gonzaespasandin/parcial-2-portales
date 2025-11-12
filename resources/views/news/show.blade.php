<?php
// @var App\Models\News $news
?>


<x-layouts.main>
    <x-slot:title>{{ $news->title }}</x-slot:title>
    <x-slot:css>href="<?= url('css/news.css'); ?>"</x-slot:css>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 w-100">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden news-show-card">
                    <div class="position-relative image-height">
                        <img src="<?= url('img/news/logo-liga-de-cohetes.png'); ?>" alt="Logo liga de cohetes" class="w-100 h-100 object-fit-cover">
                    </div>
                    <div class="card-body p-4 p-md-5">
                    <span class="badge news-show-author-badge px-3 py-2 mb-2">Juegos Epicos</span>
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                            <h1 class="h2 fw-bold mb-2 mb-md-0">{{ $news->title }}</h1>
                        </div>
                        <div class="d-flex align-items-center text-muted mb-4 gap-3 flex-wrap">
                            <div class="d-inline-flex align-items-center gap-2">
                                <i class="fas fa-calendar-alt"></i>
                                <small>{{ $news->created_at->format('d M Y') }}</small>
                                
                            </div>
                        </div>
                        <p class="fs-5 text-secondary mb-0">{{ $news->content }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 px-md-5 pb-5">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= route('news.index'); ?>" class="btn-secondary">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.main>