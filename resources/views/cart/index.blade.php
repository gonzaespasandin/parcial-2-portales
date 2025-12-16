<?php
/** @var array $cartItems */
/** @var float $total */
?>
<x-layouts.main>
    <x-slot:title>Carrito de compras - Liga de Cohetes</x-slot:title>
    <x-slot:css>href="<?= url('css/cart.css'); ?>"</x-slot:css>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden cart-card mb-4">
                    <div class="cart-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="cart-title mb-0">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Mi Carrito
                            </h1>
                            @if(!empty($cartItems) && count($cartItems) > 0)
                                <form action="{{ route('cart.clear') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i>
                                        Vaciar carrito
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        @if(empty($cartItems) || count($cartItems) === 0)
                            <div class="text-center py-5">
                                <i class="fas fa-shopping-cart text-secondary opacity-25" style="font-size: 5rem;"></i>
                                <p class="fs-4 fw-semibold text-dark mt-3 mb-2">Tu carrito está vacío</p>
                                <p class="text-muted">Explora nuestros productos y comienza a agregar al carrito</p>
                                <a href="{{ route('home') }}" class="btn btn-primary btn-lg mt-3">
                                    <i class="fas fa-store me-2"></i>
                                    Explorar Productos
                                </a>
                            </div>
                        @else
                            <div class="d-flex flex-column gap-4">
                                @foreach($cartItems as $item)
                                    <div class="cart-item">
                                        <div class="cart-item-image">
                                            @if ($item['product']->image_route !== null && \Storage::exists($item['product']->image_route))
                                                <img src="{{ \Storage::url($item['product']->image_route) }}" alt="{{ $item['product']->image_description }}" class="w-100 h-100 object-fit-cover">
                                            @else
                                                <img src="{{ \Storage::url('images/logo-liga-de-cohetes.png') }}" alt="Logo de la Liga de Cohetes" class="w-100 h-100 object-fit-cover">
                                            @endif
                                        </div>
                                        <div class="flex-fill d-flex flex-column justify-content-center">
                                            <h3 class="fs-4 fw-bold text-dark mb-2">{{ $item['product']->title }}</h3>
                                            <p class="text-muted mb-3">{{ $item['product']->subtitle }}</p>
                                            <div class="d-flex align-items-center flex-wrap gap-2">
                                                <span class="badge badge-type badge-{{ strtolower($item['product']->type) }}">
                                                    {{ $item['product']->type }}
                                                </span>
                                                <span class="cart-item-quantity">
                                                    <i class="fas fa-box me-1"></i>
                                                    Cantidad: {{ $item['quantity'] }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-end justify-content-center flex-shrink-0">
                                            <div class="price-value">{{ number_format($item['product']->price, 0, ',', '.') }} AR$</div>
                                            <form action="{{ route('cart.remove', ['id' => $item['product']->id]) }}" method="post" class="mt-3">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash me-1"></i>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                @if(!empty($cartItems) && count($cartItems) > 0)
                    <div class="card shadow-lg border-0 rounded-4 cart-summary">
                        <div class="card-header-summary">
                            <h2 class="summary-title">
                                <i class="fas fa-calculator me-2"></i>
                                Resumen de Compra
                            </h2>
                        </div>
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                <span class="fs-5 text-secondary fw-semibold">Productos ({{ count($cartItems) }})</span>
                                <span class="fs-5 text-dark fw-bold">{{ number_format($total, 0, ',', '.') }} AR$</span>
                            </div>
                            <div class="summary-total d-flex justify-content-between align-items-center">
                                <span class="summary-label fw-bold">Total</span>
                                <span class="price-value">{{ number_format($total, 0, ',', '.') }} AR$</span>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <form action="{{ route('mercadopago.create-preference') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-credit-card me-2"></i>
                                        Proceder al pago
                                    </button>
                                </form>
                                <a href="{{ route('home') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Seguir comprando
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.main>