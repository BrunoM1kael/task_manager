<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body class="bg-dark text-light">
    @auth
    <nav class="navbar-expand-lg navbar-dark bg-dark navContent">
            <div>
                <a class="navbar-brand" href="{{ route('task.index') }}">Tarefas</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                </button>
            </div>
            <div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user"></i> Menu
                        </a>
                        <ul class="dropdown-menu text-wrap" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item text-light" href="{{ route('user.changepassword') }}">
                                    <i class="fa-solid fa-key text-light"></i> Trocar Senha
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-light" href="{{ route('logout') }}">
                                    <i class="fa-solid fa-right-from-bracket text-light"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        @endauth
    </nav>

    <!-- Conteúdo Principal -->
    <div class="d-flex flex-column bgMainColor" style="min-height: 100vh;">
        <div class="container mt-5 p-5" style="flex: 1 0 auto;">
            <h2 class="mb-4">@yield('cabecalho')</h2>
            @yield('content')
        </div>

        <!-- Rodapé -->
        <footer class="text-center mt-4">
            <p>&copy; {{ date('Y') }} - Tarefas</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
