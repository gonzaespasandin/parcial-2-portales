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
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de vaciar el carrito?')">
                                        <i class="fas fa-trash me-1"></i>
                                        Vaciar carrito
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4 p-lg-5">
                        @if(empty($cartItems) || count($cartItems) === 0)
                            <div class="empty-state">
                                <i class="fas fa-shopping-cart"></i>
                                <p class="empty-message">Tu carrito está vacío</p>
                                <p class="text-muted">Explora nuestros productos y comienza a agregar al carrito</p>
                                <a href="{{ route('home') }}" class="btn btn-primary btn-lg mt-3">
                                    <i class="fas fa-store me-2"></i>
                                    Explorar Productos
                                </a>
                            </div>
                        @else
                            <div class="cart-items">
                                @foreach($cartItems as $item)
                                    <div class="cart-item">
                                        <div class="cart-item-image">
                                            @if ($item['product']->imageRoute !== null && \Storage::exists($item['product']->imageRoute))
                                                <img src="{{ \Storage::url($item['product']->imageRoute) }}" alt="{{ $item['product']->imageDescription }}">
                                            @else
                                                <img src="{{ \Storage::url('images/logo-liga-de-cohetes.png') }}" alt="Logo de la Liga de Cohetes">
                                            @endif
                                        </div>
                                        <div class="cart-item-details">
                                            <h3 class="cart-item-title">{{ $item['product']->title }}</h3>
                                            <p class="cart-item-subtitle">{{ $item['product']->subtitle }}</p>
                                            <div class="cart-item-meta">
                                                <span class="badge badge-type badge-{{ strtolower($item['product']->type) }}">
                                                    {{ $item['product']->type }}
                                                </span>
                                                <span class="cart-item-quantity">
                                                    <i class="fas fa-box me-1"></i>
                                                    Cantidad: {{ $item['quantity'] }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="cart-item-price">
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
                            <div class="summary-row">
                                <span class="summary-label">Productos ({{ count($cartItems) }})</span>
                                <span class="summary-value">{{ number_format($total, 0, ',', '.') }} AR$</span>
                            </div>
                            <div class="summary-row summary-total">
                                <span class="summary-label">Total</span>
                                <span class="summary-value">{{ number_format($total, 0, ',', '.') }} AR$</span>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button class="btn btn-primary btn-lg">
                                    <i class="fas fa-credit-card me-2"></i>
                                    Proceder al pago
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
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