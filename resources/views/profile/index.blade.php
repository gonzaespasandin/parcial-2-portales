<x-layouts.main>
    <x-slot:title>Mi Perfil - Liga de Cohetes</x-slot:title>
    <x-slot:css>href="<?= url('css/profile.css'); ?>"</x-slot:css>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden profile-card mb-4">
                    <div class="profile-header">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary text-white px-3 py-2">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        <div class="profile-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h1 class="profile-title">Mi Perfil</h1>
                    </div>
                    <div class="card-body p-4 p-lg-5">
                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Nombre</div>
                                        <div class="info-value">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Email</div>
                                        <div class="info-value">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Fecha de registro</div>
                                        <div class="info-value">{{ $user->created_at->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Total de compras</div>
                                        <div class="info-value">{{ $user->purchases->count() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-lg border-0 rounded-4 profile-card">
                    <div class="card-header-profile">
                        <h2 class="section-title" id="historial-de-compras">
                            <i class="fas fa-history me-2"></i>
                            Historial de Compras
                        </h2>
                    </div>
                    <div class="card-body p-4 p-lg-5">
                        <!-- TODO: Agregar paginación -->
                        @if($user->purchases->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover purchases-table">
                                    <thead>
                                        <tr>
                                            <th class="text-start">Producto</th>
                                            <th class="text-center">Tipo</th>
                                            <th class="text-end">Fecha de compra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->purchases->sortByDesc('purchased_at') as $purchase)
                                            <tr>
                                                <td class="product-name">
                                                    <i class="fas fa-box me-2"></i>
                                                    {{ $purchase->product->title }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-type badge-{{ strtolower($purchase->product->type) }}">
                                                        {{ $purchase->product->type }}
                                                    </span>
                                                </td>
                                                <td class="text-end">
                                                    <i class="fas fa-calendar me-2"></i>
                                                    {{ $purchase->purchased_at->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-shopping-cart"></i>
                                <p class="empty-message">Aún no has realizado ninguna compra</p>
                                <a href="{{ route('home') }}" class="btn-primary btn mt-3">
                                    <i class="fas fa-store me-2"></i>
                                    Explorar Productos
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>