<x-layouts.main>
    <x-slot:title>Panel de Administración - Usuarios</x-slot:title>
    <x-slot:css>href="<?= url('css/admin.css'); ?>"</x-slot:css>
    
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-1 fw-bold text-center mb-5">Panel de Administración</h1>
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
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">¿Compró el Juego?</th>
                                <th class="text-center">¿Compró Complementos?</th>
                                <th class="text-center">Fecha Última Compra</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
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
                                </tr>
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