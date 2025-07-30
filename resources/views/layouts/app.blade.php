<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OdontoSys - Gestão de Consultório</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="sidebar">
        <div class="logo mb-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logotipo OdontoSys">
        </div>
        <hr>
        <div class="sidebar-nav">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item mb-2">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ Request::is('consultas*') ? 'active' : '' }}" href="{{ route('consultas.index') }}">Agenda</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ Request::is('pacientes*') ? 'active' : '' }}" href="{{ route('pacientes.index') }}">Pacientes</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ Request::is('profissionais*') ? 'active' : '' }}" href="{{ route('profissionais.index') }}">Profissionais</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ Request::is('funcionarios*') ? 'active' : '' }}" href="{{ route('funcionarios.index') }}">Funcionários</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ Request::is('orcamentos*') ? 'active' : '' }}" href="{{ route('orcamentos.index') }}">Orçamentos</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ Request::is('procedimentos*') ? 'active' : '' }}" href="{{ route('procedimentos.index') }}">Procedimentos</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ Request::is('especialidades*') ? 'active' : '' }}" href="{{ route('especialidades.index') }}">Especialidades</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ Request::is('estoque*') ? 'active' : '' }}" href="{{ route('estoque.index') }}">Estoque</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ Request::is('relatorio-financeiro') ? 'active' : '' }}" href="{{ route('relatorios.financeiro') }}">Relatório Financeiro</a>
                </li>
                @can('manage-users')
                    <li class="nav-item mb-2">
                        <a class="nav-link {{ Request::is('usuarios*') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">Usuários</a>
                    </li>
                @endcan
            </ul>
        </div>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <strong>{{ Auth::user()->login }} ({{ Auth::user()->tipo }})</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            Sair
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/imask"></script>
    @stack('scripts')
</body>
</html>