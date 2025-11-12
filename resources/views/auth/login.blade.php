<x-layouts.main>
    <x-slot:title>Ingresar a mi cuenta</x-slot:title>
    <x-slot:css>href="<?= url('css/forms.css'); ?>"</x-slot:css>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 col-xl-5">
                <div class="card form-card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-center">
                            <h1 class="h4 mb-4">Ingresar</h1>
                        </div>
                        <form action="{{ route('auth.login.process') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email')is-invalid @enderror" @error('email') aria-invalid="true" aria-errormessage="{{ $message }}" @enderror value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control @error('password')is-invalid @enderror" @error('password') aria-invalid="true" aria-errormessage="{{ $message }}" @enderror>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>