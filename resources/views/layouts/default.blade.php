<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Laravel - PayNet')</title>

    <link rel="stylesheet" href="css/app.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/default.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2.11.8/dist/umd/popper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
            width: 100%;
        }

        footer {
            width: 100%;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">PayNet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}"><i class="fa-solid fa-house"></i></a>
                    </li>

                    <li class="nav-item" id="nav-login">
                        <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                    </li>
                    <li class="nav-item" id="nav-register">
                        <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                    </li>
                    <li class="nav-item d-none" id="nav-logout">
                        <a class="nav-link" href="{{ route('logout') }}">
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        @yield('content')

    </div>

    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        PayNet - Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>

    <script>
        $('#nav-logout a').on('click', function(event) {
            event.preventDefault();

            const token = localStorage.getItem('auth_token');

            if (token) {
                localStorage.removeItem('auth_token');
                window.location.href = "{{ route('login') }}";
            } else {
                window.location.href = "{{ route('login') }}";
            }
        });
    </script>
</body>

</html>
