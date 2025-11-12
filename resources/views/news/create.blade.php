<x-layouts.main>
    <x-slot:title>Crear noticia</x-slot:title>
    <x-slot:css>href="<?= url('css/forms.css'); ?>"</x-slot:css>

    <div class="container py-4">
        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <span>Por favor, corrige los siguientes errores:</span>
            </div>
        @endif

        <!-- a este form despues se le agregara la foto, el usuario que lo creo y la categoria -->

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="card form-card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-center">
                            <h1 class="h4 mb-4">Crear noticia</h1>
                        </div>
                        <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input 
                                    type="text" name="title" id="title" class="form-control @error('title')is-invalid @enderror" @error('title') aria-invalid="true" aria-errormessage="{{ $message }}" @enderror
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Contenido de la noticia</label>
                                <textarea name="content" id="content" class="form-control @error('content')is-invalid @enderror" @error('content') aria-invalid="true" aria-errormessage="{{ $message }}" @enderror>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen</label>
                                <input type="file" name="image" id="image" class="form-control @error('image')is-invalid @enderror" @error('image') aria-invalid="true" aria-errormessage="{{ $message }}" @enderror>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image_description" class="form-label">Descripción de la imagen</label>
                                <textarea name="image_description" id="image_description" class="form-control @error('image_description')is-invalid @enderror" @error('image_description') aria-invalid="true" aria-errormessage="{{ $message }}" @enderror>{{ old('image_description') }}</textarea>

                                @error('image_description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>