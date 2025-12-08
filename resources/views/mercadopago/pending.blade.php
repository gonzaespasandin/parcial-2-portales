<x-layouts.main>
    <x-slot:title>Pago Pendiente - Liga de Cohetes</x-slot:title>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <i class="fas fa-clock text-warning" style="font-size: 5rem;"></i>
                        </div>
                        <h1 class="fw-bold mb-3">Pago Pendiente</h1>
                        <p class="text-muted mb-4 fs-5">
                            Tu pago está siendo procesado. Te notificaremos cuando se confirme la transacción.
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('home') }}" class="btn btn-warning">
                                <i class="fas fa-home me-2"></i>
                                Volver al Inicio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>

