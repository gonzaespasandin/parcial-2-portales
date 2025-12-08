<?php
/** @var \MercadoPago\Resources\Preference $preference */
/** @var string $MPPublicKey */
?>
<x-layouts.main>
    <x-slot:title>Checkout - Liga de Cohetes</x-slot:title>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4 p-lg-5 text-center">
                        <h1 class="mb-4">
                            <i class="fas fa-credit-card me-2"></i>
                            Finalizar Compra
                        </h1>
                        <p class="text-muted mb-4">
                            Serás redirigido para completar tu pago de forma segura
                        </p>
                        <div id="wallet_container"></div>
                        <a href="{{ route('cart.index') }}" class="btn btn-secondary mt-3">
                            <i class="fas fa-arrow-left me-2"></i>
                            Volver al carrito
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        const mp = new MercadoPago('{{ $MPPublicKey }}');
        
        mp.bricks().create('wallet', 'wallet_container', {
            initialization: {
                preferenceId: '{{ $preference->id }}',
            }
        });
    </script>
</x-layouts.main>