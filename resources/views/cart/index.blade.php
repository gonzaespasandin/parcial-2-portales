<x-layouts.main>
    <x-slot:title>Carrito de compras - Liga de Cohetes</x-slot:title>
    <x-slot:css>href="<?= url('css/cart.css'); ?>"</x-slot:css>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden cart-card">
                    <div class="card-header text-dark py-3">
                        <h2 class="h4 mb-0 fw-bold">Carrito de compras</h2>
                    </div>
                    <div class="card-body p-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td>{{ $item['product']->title }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>