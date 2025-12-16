<x-layouts.main>
    <x-slot:title>Panel de Administración - Usuarios</x-slot:title>
    <x-slot:css>href="<?= url('css/admin.css'); ?>"</x-slot:css>
    
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-1 fw-bold text-center mb-5">Panel de Administración</h1>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <p class="text-muted mb-2"><i class="fas fa-trophy me-2 text-warning"></i>Producto más vendido</p>
                        <div class="d-flex align-items-center gap-3">
                            <div class="ratio ratio-1x1 rounded-circle overflow-hidden img-product">
                                @if(!empty($topProduct?->image_route))
                                    <img src="{{ \Storage::url($topProduct->image_route) }}" class="img-fluid" alt="Producto más vendido">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center h-100 text-muted">
                                        <i class="fas fa-box"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="fw-bold h6 mb-1">{{ $topProduct->title ?? 'Sin datos' }}</p>
                                <small class="text-muted">{{ $topProduct->purchases_count ?? 0 }} uds.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <p class="text-muted mb-2"><i class="fas fa-calendar-alt me-2 text-primary"></i>Mes con más ventas</p>
                        <p class="fw-bold h6 mb-1">{{ $topMonthLabel ?? 'Sin datos' }}</p>
                        <small class="text-muted"><i class="fas fa-dollar-sign me-1"></i>{{ number_format($topMonth->amount ?? 0, 2, ',', '.') }}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <p class="text-muted mb-2"><i class="fas fa-coins me-2 text-success"></i>Recaudado total</p>
                        <p class="fw-bold h6 mb-0"><i class="fas fa-dollar-sign me-1"></i>{{ number_format($totalRevenue ?? 0, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <p class="text-muted mb-2"><i class="fas fa-receipt me-2 text-info"></i>Órdenes totales</p>
                        <p class="fw-bold h6 mb-0">{{ $ordersCount ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm border-0">
            <div class="card-header text-dark py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0 fw-bold">Listado de Usuarios</h2>
                    <span class="badge bg-light text-dark fs-6">
                        Total: {{ $users->total() }}
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 50px;"></th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">¿Compró el Juego?</th>
                                <th class="text-center">¿Compró Complementos?</th>
                                <th class="text-center">Fecha Última Compra</th>
                                <th class="text-center">Total Gastado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">
                                        @if($user->purchases->isNotEmpty())
                                            <button class="btn btn-sm btn-outline-primary" type="button" 
                                                    data-bs-toggle="collapse" 
                                                    data-bs-target="#purchases-{{ $user->id }}" 
                                                    aria-expanded="false">
                                                <i class="fas fa-chevron-down"></i>
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center fw-semibold">{{ $user->name }}</td>
                                    <td class="text-center">
                                        <span class="text-muted">{{ $user->email }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($user->hasGame())
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>
                                                SI
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i>
                                                NO
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($user->hasComplements())
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>
                                                SI
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i>
                                                NO
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="text-muted">
                                            {{ $user->getLastPurchaseDate() }}
                                        </span>
                                    </td>
                                    <td class="text-center fw-bold">
                                        ${{ number_format($user->purchases->sum(fn($p) => $p->product->price), 2, ',', '.') }}
                                    </td>
                                </tr>
                                @if($user->purchases->isNotEmpty())
                                <tr class="collapse" id="purchases-{{ $user->id }}">
                                    <td colspan="7" class="p-0">
                                        <div class="bg-light p-3">
                                            <h3 class="fw-bold h6 mb-3"><i class="fas fa-shopping-bag me-2"></i>Detalle de Compras</h3>
                                            <table class="table table-sm table-bordered bg-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Producto</th>
                                                        <th class="text-center">Tipo</th>
                                                        <th class="text-center">Precio</th>
                                                        <th class="text-center">Fecha de Compra</th>
                                                        <th class="text-center">Método de Pago</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($user->purchases as $purchase)
                                                        <tr>
                                                            <td class="text-center">
                                                                <span class="badge bg-primary-subtle text-primary">
                                                                    {{ $purchase->product->title }}
                                                                </span>
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge badge-type @if($purchase->product->type == 'Juego') badge-juego @else badge-complemento @endif">
                                                                    {{ $purchase->product->type }}
                                                                </span>
                                                            </td>
                                                            <td class="text-center fw-semibold text-success">
                                                                ${{ number_format($purchase->product->price, 2, ',', '.') }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $purchase->purchased_at->format('d/m/Y H:i') }}
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge bg-info-subtle text-info">
                                                                    @switch($purchase->payment_method)
                                                                        @case('transfer')
                                                                            Transferencia
                                                                            @break
                                                                        @case('credit_card')
                                                                            Tarjeta de crédito
                                                                            @break
                                                                        @case('debit_card')
                                                                            Tarjeta de débito
                                                                            @break
                                                                        @case('mercado_pago')
                                                                            Mercado Pago
                                                                            @break
                                                                        @default
                                                                            Método de pago desconocido
                                                                            @break
                                                                    @endswitch
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($users->isEmpty())
                <div class="card-body text-center py-5">
                    <p class="text-muted mb-0">No hay usuarios registrados</p>
                </div>
            @endif
            <div class="card-footer py-4s">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>