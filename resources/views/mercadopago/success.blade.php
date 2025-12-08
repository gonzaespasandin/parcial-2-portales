<x-layouts.main>
    <x-slot:title>Pago Exitoso - Liga de Cohetes</x-slot:title>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                        </div>
                        <h1 class="text-success fw-bold mb-3">¡Compra Exitosa!</h1>
                        <p class="text-muted mb-4 fs-5">
                            Tu pago se procesó correctamente y los productos ya están disponibles en tu perfil.
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('profile.index') }}#historial-de-compras" class="btn btn-success">
                                <i class="fas fa-user-circle me-2"></i>
                                Ver mis Compras
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>

