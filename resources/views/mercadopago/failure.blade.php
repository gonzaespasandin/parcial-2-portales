<x-layouts.main>
    <x-slot:title>Pago Rechazado - Liga de Cohetes</x-slot:title>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-5 text-center">
                        <div class="mb-4">
                            <i class="fas fa-times-circle text-danger" style="font-size: 5rem;"></i>
                        </div>
                        <h1 class="text-danger fw-bold mb-3">Pago Rechazado</h1>
                        <p class="text-muted mb-4 fs-5">
                            No pudimos procesar tu pago. Por favor, intenta nuevamente con otro método de pago.
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('cart.index') }}" class="btn btn-danger">
                                <i class="fas fa-cart-shopping me-2"></i>
                                Volver al carrito
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>

