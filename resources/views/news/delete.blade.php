<?php
// @var App\Models\News $news
?>

<x-layouts.main>
    <x-slot:title>Confirmación de eliminación - {{ $news->title }}</x-slot:title>
    <x-slot:css>href="<?= url('css/forms.css'); ?>"</x-slot:css>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="card form-card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-center">
                            <h1 class="h4 mb-3">Confirmación de eliminación</h1>
                        </div>
                        <p class="mb-4">¿Estás seguro de querer eliminar la noticia <b>{{ $news->title }}</b>?</p>
                        <form action="{{ route('news.destroy', ['id' => $news->id]) }}" method="post" class="d-flex justify-content-center">
                            @csrf
                            @method('POST')
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                <a href="<?= route('news.index'); ?>" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>