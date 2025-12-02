<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GameShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030;
            background-color: #13012e !important;
        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: 500;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: #a0aec0 !important;
        }

        /* content area ajustado para navbar e footer fixos */
        .content-wrapper {
            flex: 1;
            margin-top: 70px; /* espaço para navbar */
            margin-bottom: 90px; /* espaço para footer */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1020;
            background-color: #13012e !important;
        }
        footer p {
            color: white !important;
            margin: 0;
            font-weight: 500;
        }

        /* FLASH MESSAGE (topo) */
        #flash-message {
            position: fixed;
            top: 12px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1200;
            min-width: 320px;
            max-width: calc(100% - 40px);
            display: none;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0,0,0,.2);
            overflow: hidden;
        }
        #flash-message.show { display: block; animation: slideDown .35s ease; }
        @keyframes slideDown {
            from { transform: translate(-50%, -20px); opacity: 0; }
            to   { transform: translate(-50%, 0); opacity: 1; }
        }

        /* Paginação estilizada */
        .pagination {
            gap: .35rem;
        }
        .pagination .page-item .page-link {
            border-radius: 8px;
            padding: .45rem .65rem;
            border: 0;
            color: #13012e;
            background: #f1f5f9;
            box-shadow: 0 2px 6px rgba(19,1,46,.06);
            transition: transform .12s ease, background .12s ease;
            min-width: 40px;
            text-align: center;
        }
        .pagination .page-item .page-link:hover {
            transform: translateY(-3px);
            background: #e2e8f0;
        }
        .pagination .page-item.active .page-link {
            background: #13012e;
            color: #fff;
            box-shadow: 0 6px 18px rgba(19,1,46,.18);
        }
        .pagination .page-item.disabled .page-link {
            opacity: .55;
            cursor: not-allowed;
        }

        /* Ajuste responsivo para o flash em telas pequenas */
        @media (max-width: 576px) {
            #flash-message { left: 8px; transform: none; right: 8px; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-gamepad"></i> GameShop
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('games.index') }}">
                            <i class="fas fa-star"></i> Jogos
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i> Carrinho
                            @if(count(session()->get('cart', [])))
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ array_sum(array_column(session()->get('cart', []), 'quantity')) }}
                                </span>
                            @endif
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">
                                <i class="fas fa-receipt"></i> Meus Pedidos
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">
                                    <i class="fas fa-sign-out-alt"></i> Sair
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i> Entrar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i> Registrar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- FLASH MESSAGE TOPO -->
    <div id="flash-message" aria-live="polite" aria-atomic="true">
        @if(session('success'))
            <div class="alert alert-success mb-0 d-flex align-items-center" role="alert" id="flash-content">
                <div class="px-3 py-2"><i class="fas fa-check-circle fa-lg"></i></div>
                <div class="flex-grow-1 px-2">{{ session('success') }}</div>
                <button type="button" class="btn-close me-2" aria-label="Fechar" onclick="hideFlash()"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger mb-0 d-flex align-items-center" role="alert" id="flash-content">
                <div class="px-3 py-2"><i class="fas fa-exclamation-circle fa-lg"></i></div>
                <div class="flex-grow-1 px-2">{{ session('error') }}</div>
                <button type="button" class="btn-close me-2" aria-label="Fechar" onclick="hideFlash()"></button>
            </div>
        @endif
    </div>

    <div class="content-wrapper">
        {{-- ...existing code... --}}
        {{-- removida duplicação de mensagens aqui para usar o flash fixo no topo --}}
        @yield('content')
    </div>

    <footer class="text-white py-4">
        <div class="container-fluid text-center">
            <p><i class="fas fa-copyright"></i> {{ date('Y') }} GameShop. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostra flash automaticamente e oculta após X ms
        function hideFlash() {
            const f = document.getElementById('flash-message');
            if (!f) return;
            f.classList.remove('show');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const flash = document.getElementById('flash-message');
            if (!flash) return;
            const hasContent = flash.querySelector('#flash-content');
            if (hasContent) {
                // mostra
                flash.classList.add('show');
                // esconde após 4500ms
                setTimeout(() => {
                    flash.classList.remove('show');
                }, 4500);
            }
        });
    </script>
</body>
</html>