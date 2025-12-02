@extends('layouts.app')

@section('content')
<div class="welcome-container">
    <div class="welcome-content">
        <div class="text-center mb-5">
            <h1 class="display-3 fw-bold mb-3">
                <i class="fas fa-gamepad"></i> Bem-vindo ao GameShop
            </h1>
            <p class="lead text-muted mb-4">
                Descubra os melhores jogos do mercado com os melhores preços
            </p>
        </div>

        <div class="row g-4 mb-5">
            <!-- Card Explorar Jogos -->
            <div class="col-md-4">
                <div class="feature-card shadow-sm">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h5>Explorar Jogos</h5>
                    <p class="text-muted">Navegue por nossa coleção exclusiva de jogos para todas as plataformas</p>
                    <a href="{{ route('games.index') }}" class="btn btn-purple btn-sm">
                        <i class="fas fa-arrow-right"></i> Ver Jogos
                    </a>
                </div>
            </div>

            <!-- Card Carrinho -->
            <div class="col-md-4">
                <div class="feature-card shadow-sm">
                    <div class="feature-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <h5>Comprar com Segurança</h5>
                    <p class="text-muted">Compre com confiança em nossa plataforma segura e confiável</p>
                    <a href="{{ route('games.index') }}" class="btn btn-purple btn-sm">
                        <i class="fas fa-arrow-right"></i> Começar
                    </a>
                </div>
            </div>

            <!-- Card Suporte -->
            <div class="col-md-4">
                <div class="feature-card shadow-sm">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5>Suporte 24/7</h5>
                    <p class="text-muted">Nossa equipe está sempre pronta para ajudá-lo com qualquer dúvida</p>
                    <a href="#" class="btn btn-purple btn-sm">
                        <i class="fas fa-arrow-right"></i> Contato
                    </a>
                </div>
            </div>
        </div>

        <!-- Banner Principal -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="banner-principal">
                    <div class="banner-content">
                        <h2 class="h1 fw-bold mb-3">
                            <i class="fas fa-fire"></i> Aproveite as Melhores Ofertas!
                        </h2>
                        <p class="fs-5 mb-4">Encontre os jogos mais populares com preços incríveis</p>
                        <a href="{{ route('games.index') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-star"></i> Explorar Catálogo
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="row text-center g-4 mb-5">
            <div class="col-md-3">
                <div class="feature-box">
                    <i class="fas fa-lock"></i>
                    <h6 class="mt-3">Seguro</h6>
                    <p class="small text-muted">Pagamento criptografado</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box">
                    <i class="fas fa-bolt"></i>
                    <h6 class="mt-3">Rápido</h6>
                    <p class="small text-muted">Entrega instantânea</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box">
                    <i class="fas fa-redo"></i>
                    <h6 class="mt-3">Troca Fácil</h6>
                    <p class="small text-muted">Devolvemos seu dinheiro</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box">
                    <i class="fas fa-headset"></i>
                    <h6 class="mt-3">Suporte</h6>
                    <p class="small text-muted">Ajuda em português</p>
                </div>
            </div>
        </div>

        <!-- CTA Final -->
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info border-0 text-center py-4">
                    <h5 class="mb-3">Pronto para começar?</h5>
                    <p class="mb-3">Crie sua conta agora e aproveite as melhores ofertas</p>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-purple btn-lg me-2">
                            <i class="fas fa-user-plus"></i> Criar Conta
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-purple btn-lg">
                            <i class="fas fa-sign-in-alt"></i> Entrar
                        </a>
                    @else
                        <a href="{{ route('games.index') }}" class="btn btn-purple btn-lg">
                            <i class="fas fa-star"></i> Ver Jogos
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .welcome-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 56px - 90px);
        padding: 40px 20px;
    }

    .welcome-content {
        width: 100%;
        max-width: 1200px;
    }

    .feature-card {
        background: white;
        border: 0;
        border-radius: 12px;
        padding: 30px 20px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(111, 66, 193, 0.15) !important;
    }

    .feature-icon {
        font-size: 48px;
        color: #6f42c1;
        margin-bottom: 15px;
    }

    .feature-card h5 {
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .banner-principal {
        background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
        color: white;
        border-radius: 12px;
        padding: 60px 40px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(111, 66, 193, 0.2);
    }

    .banner-content {
        max-width: 600px;
        margin: 0 auto;
    }

    .feature-box {
        padding: 20px;
    }

    .feature-box i {
        font-size: 40px;
        color: #6f42c1;
    }

    .feature-box h6 {
        font-weight: 600;
        color: #333;
    }

    .btn-purple {
        background-color: #6f42c1;
        color: #fff;
        border-color: #6f42c1;
    }

    .btn-purple:hover {
        background-color: #5a32a3;
        color: #fff;
        border-color: #5a32a3;
        box-shadow: 0 6px 18px rgba(111, 66, 193, 0.25) !important;
    }

    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
    }

    .btn-outline-purple:hover {
        background-color: #6f42c1;
        color: #fff;
        box-shadow: 0 6px 18px rgba(111, 66, 193, 0.18) !important;
    }

    .alert-info {
        background-color: #e7f3ff;
        border-color: #b3d9ff;
        color: #004085;
    }

    @media (max-width: 768px) {
        .welcome-container {
            min-height: auto;
            padding: 20px;
        }

        .banner-principal {
            padding: 40px 20px;
        }

        .display-3 {
            font-size: 2rem !important;
        }

        .lead {
            font-size: 1rem;
        }
    }
</style>
@endsection
