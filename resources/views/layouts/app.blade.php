<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RoseLab') | RoseLab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --ciruela: #79536f;
            --ciruela-oscuro: #56394f;
            --fondo: #f7f5f8;
            --texto: #302833;
            --gris: #89818c;
            --borde: #eee8ef;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--fondo);
            color: var(--texto);
            font-family: Arial, Helvetica, sans-serif;
        }

        .topbar {
            height: 78px;
            background: white;
            border-bottom: 1px solid var(--borde);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            font-size: 27px;
            font-weight: 800;
            color: var(--texto);
            text-decoration: none;
            letter-spacing: -.8px;
        }

        .brand span {
            color: var(--ciruela);
        }

        .brand-subtitle {
            font-size: 10px;
            color: var(--gris);
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: -3px;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #f0e6ef;
            color: var(--ciruela);
            font-size: 19px;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
        }

        .user-role {
            color: var(--gris);
            font-size: 12px;
            margin-top: 3px;
        }

        .btn-logout {
            background: white;
            color: #a13f4b;
            border: 1px solid #eedde1;
            padding: 10px 13px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-logout:hover {
            background: #fff0f2;
        }

        .app-layout {
            display: flex;
            min-height: calc(100vh - 78px);
        }

        .sidebar {
            width: 245px;
            min-width: 245px;
            background: white;
            border-right: 1px solid var(--borde);
            padding: 27px 17px;
            display: flex;
            flex-direction: column;
        }

        .menu-heading {
            color: #a59ba7;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            padding: 0 13px;
            margin: 5px 0 13px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            margin-bottom: 7px;
            border-radius: 11px;
            color: #716775;
            text-decoration: none;
            font-size: 13px;
            transition: .2s;
        }

        .nav-link-custom i {
            font-size: 18px;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            background: #f2eaf3;
            color: var(--ciruela-oscuro);
        }

        .nav-link-custom.active {
            font-weight: 700;
        }

        .sidebar-note {
            margin-top: auto;
            background: #f7f1f7;
            padding: 17px;
            border-radius: 13px;
            color: #6e5870;
            font-size: 12px;
            line-height: 1.6;
        }

        .sidebar-note i {
            font-size: 21px;
            display: block;
            margin-bottom: 9px;
        }

        .content-area {
            flex: 1;
            min-width: 0;
            padding: 32px;
        }

        .main-content {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 27px;
            font-weight: 750;
            margin-bottom: 8px;
        }

        .page-description {
            color: var(--gris);
            line-height: 1.6;
        }

        .stat-card,
        .panel {
            background: white;
            border: 1px solid var(--borde);
            border-radius: 17px;
            padding: 23px;
            box-shadow: 0 5px 22px rgba(49, 35, 46, .035);
        }

        .stat-label {
            color: var(--gris);
            font-size: 13px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 750;
            margin-top: 14px;
            margin-bottom: 5px;
        }

        .stat-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f2eaf3;
            color: var(--ciruela);
            font-size: 21px;
        }

        .btn-primary {
            background: var(--ciruela);
            border-color: var(--ciruela);
        }

        .btn-primary:hover {
            background: var(--ciruela-oscuro);
            border-color: var(--ciruela-oscuro);
        }

        .table thead th {
            background: #faf8fb;
            color: #716775;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            padding: 15px;
            border-bottom: 1px solid var(--borde);
        }

        .table tbody td {
            padding: 15px;
            border-color: #f0ebf0;
        }

        .status-available,
        .status-loaned {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-available {
            background: #e8f5ec;
            color: #287747;
        }

        .status-loaned {
            background: #fff0df;
            color: #9a5b16;
        }

        .footer {
            text-align: center;
            color: var(--gris);
            padding: 25px 10px 5px;
            font-size: 11px;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 205px;
                min-width: 205px;
            }

            .content-area {
                padding: 23px;
            }

            .topbar {
                padding: 0 18px;
            }
        }

        @media (max-width: 650px) {
            .topbar {
                height: auto;
                min-height: 75px;
                padding: 15px;
                gap: 12px;
                flex-wrap: wrap;
            }

            .app-layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                min-width: 0;
                padding: 15px;
                border-right: none;
                border-bottom: 1px solid var(--borde);
            }

            .sidebar nav {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 5px;
            }

            .nav-link-custom {
                margin: 0;
                padding: 11px;
            }

            .sidebar-note {
                display: none;
            }

            .content-area {
                padding: 20px 14px;
            }

            .user-name,
            .user-role {
                display: none;
            }

            .btn-logout {
                padding: 9px;
            }
        }
    </style>
</head>

<body>
    @auth
        <header class="topbar">
            <a href="{{ route('dashboard') }}" class="brand">
                Rose<span>Lab</span>
                <div class="brand-subtitle">Gestión de equipos</div>
            </a>

            <div class="user-area">
                <div class="user-avatar">
                    <i class="bi bi-person"></i>
                </div>

                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">{{ ucfirst(auth()->user()->rol ?? 'Usuario') }}</div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </header>

        <div class="app-layout">
            <aside class="sidebar">
                <div class="menu-heading">MENÚ PRINCIPAL</div>

                <nav>
                    <a href="{{ route('dashboard') }}"
                       class="nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2"></i>
                        Inicio
                    </a>

                    @if (auth()->user()->rol === 'encargado')
                        <a href="{{ route('equipos.index') }}"
                           class="nav-link-custom {{ request()->routeIs('equipos.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i>
                            Equipos
                        </a>

                        <a href="{{ route('prestamos.index') }}"
                           class="nav-link-custom {{ request()->routeIs('prestamos.*') ? 'active' : '' }}">
                            <i class="bi bi-arrow-left-right"></i>
                            Préstamos
                        </a>
                    @endif
                </nav>

                <div class="sidebar-note">
                    <i class="bi bi-stars"></i>
                    <strong>RoseLab</strong>
                    <div>Organiza y administra tus equipos desde un solo lugar.</div>
                </div>
            </aside>

            <div class="content-area">
                <main class="main-content">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif

                    @yield('content')
                </main>

                <footer class="footer">
                    RoseLab · Sistema de gestión de equipos
                </footer>
            </div>
        </div>
    @else
        <main class="container py-5">
            @yield('content')
        </main>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
