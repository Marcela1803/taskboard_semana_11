<!DOCTYPE html>
{{-- Semana 7 · Blade — Layout maestro --}}
{{-- Toda vista hija hereda esta estructura con @extends('layouts.app') --}}
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Pasarela de Pagos — TaskBoard')</title>

    <style>
        :root {
            --navy: #0B2E59;
            --gold: #F2A900;
            --ink: #13233D;
            --gray: #5B6B85;
            --line: #D7E1EF;
            --bg: #F5F8FC;
            --green: #1E7E52;
            --red: #C23B32;
        }
        * { box-sizing: border-box; }
        body {
            font-family: -apple-system, "Segoe UI", Calibri, Arial, sans-serif;
            background: var(--bg);
            color: var(--ink);
            margin: 0;
        }
        nav {
            background: var(--navy);
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;      
        }
        nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }
        nav .tag {
            background: var(--gold);
            color: var(--navy);
            padding: 0.2rem 0.7rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: bold;
        }
        .btn-salir {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.6);
            color: #fff;
            padding: 0.3rem 0.7rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .btn-salir:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        main {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }
        h1 { color: var(--navy); }
        h2 { color: var(--navy); font-size: 1.1rem; margin-top: 2rem; }
        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
        }
        .card a { color: var(--navy); font-weight: bold; text-decoration: none; }
        .card a:hover { text-decoration: underline; }
        .meta { color: var(--gray); font-size: 0.9rem; }
        .badge {
            display: inline-block;
            padding: 0.2rem 0.7rem;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: bold;
            color: #fff;
        }
        .badge.verde { background: var(--green); }
        .badge.rojo { background: var(--red); }
        .badge.amarillo { background: var(--gold); color: var(--navy); }
        .badge.gris { background: #9AAAC4; }
        footer {
            text-align: center;
            color: var(--gray);
            font-size: 0.85rem;
            padding: 2rem 0;
        }
        ul.comercios { list-style: none; padding: 0; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('comercios.index') }}">Pasarela de Pagos · TaskBoard</a>

        <div class="nav-right">
            {{-- Opciones para visitantes (sin sesión) --}}
            @guest
                <a href="{{ route('login') }}">Iniciar sesión</a>
                <a href="{{ route('registro') }}">Registrarse</a>
            @endguest

            {{-- Opciones para usuarios autenticados --}}
            @auth
                <span style="font-size: 0.95rem;">Hola, <strong>{{ Auth::user()->name }}</strong></span>

                <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;">
                    @csrf
                    <button type="submit" class="btn-salir">Cerrar sesión</button>
                </form>
            @endauth

            <span class="tag">UPED · Integración de Sistemas</span>
        </div>
    </nav>

    <main>
        {{-- Mensaje flash global de éxito --}}
        @if (session('mensaje'))
            <div class="alerta-exito" style="background:#EAF6EE; color:#1E7E52; padding:0.75rem 1rem; margin-bottom: 1.5rem; border-radius: 8px; border: 1px solid #C6E6D1;">
                {{ session('mensaje') }}
            </div>
        @endif

        @yield('contenido')
    </main>

    <footer>
        &copy; {{ date('Y') }} UPED — Integración de Sistemas
    </footer>
</body>
</html>