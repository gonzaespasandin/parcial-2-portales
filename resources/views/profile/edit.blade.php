<?php
    /** @var App\Models\User[] $user */
    /** @var Illuminate\Support\ViewErrorBag $errors */
?>


<x-layouts.main>
    <x-slot:title>Editar Perfil - Liga de Cohetes</x-slot:title>
    <x-slot:css>href="<?= url('css/forms.css'); ?>"</x-slot:css>

    @if($errors->any())
        <div class="alert alert-danger">
            <span>Por favor, corrige los siguientes errores:</span>
        </div>
    @endif

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="card form-card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-center">
                            <h1 class="h4 mb-4">Editar Perfil</h1>
                        </div>
                        <form action="{{ route('profile.update') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name')is-invalid @enderror"
                                    @error('name')
                                        aria-invalid="true"
                                        aria-errormessage="{{ $message }}"
                                    @enderror
                                    value="{{ old('name', $user->name) }}"
                                >
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control @error('email')is-invalid @enderror"
                                    @error('email')
                                        aria-invalid="true"
                                        aria-errormessage="{{ $message }}"
                                    @enderror
                                    value="{{ old('email', $user->email) }}"
                                >
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>