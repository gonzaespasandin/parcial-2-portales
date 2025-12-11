<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{$title ?? '' }}</title>
    <link rel="stylesheet" href="<?= url('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= url('css/style.css'); ?>">
    <link rel="stylesheet" href="<?= url('css/all.min.css'); ?>">
    @if(isset($css))
    <link rel="stylesheet" {{$css}}>
    @endif
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg rocket-navbar">
        <div class="container-fluid mx-4">
            <a class="navbar-brand d-flex align-items-center gap-3" href="<?= route('home'); ?>">
                <img src="{{ \Storage::url('images/logo.png') }}" alt="Logo de la Liga de Cohetes" class="img-fluid rocket-logo">
                <span class="rocket-brand">Liga de Cohetes</span>
            </a>
            <button class="navbar-toggler rocket-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <x-nav-link route="home">Inicio</x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link route="news.index">Noticias</x-nav-link>
                    </li>
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex justify-content-center align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-2"></i>{{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.index') }}">Mi perfil</a>
                            </li>
                            @admin
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.index') }}">Panel de administración</a>
                            </li>
                            @endadmin
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('auth.logout') }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <x-nav-link route="cart.index"><i class="fas fa-shopping-cart me-2"></i><span class="badge bg-primary rounded-pill rocket-cart-badge">{{ count(session()->get('cart', [])) }}</span></x-nav-link>
                    </li>
                    @else
                    <li class="nav-item">
                        <x-nav-link route="auth.login.show">Ingresar</x-nav-link>
                    </li>
                    <li class="nav-item">
                        <x-nav-link route="auth.register.show">Registrarme</x-nav-link>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
        </nav>
        <main class="container mt-5">
            @if(session()->has('feedback.message'))
                <div class="alert alert-{{ session()->get('feedback.type') ?? 'success' }}">
                    {!! session()->get('feedback.message') !!}
                </div>
            @endif
            {{ $slot }}
        </main>
        <footer class="footer rocket-footer mt-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 rocket-brand fw-semibold">Liga de Cohetes</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0">Todos los derechos reservados &copy; 2025</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="<?= url('js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>