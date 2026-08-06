@props([
    'activeItem' => '',
])


<header class="navbar bg-primary navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            TicketApp
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ $activeItem === "Inicio" ? 'active' : '' }}" >Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('events.index') }}" class="nav-link {{ $activeItem === "Eventos" ? 'active' : '' }}">Eventos</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $activeItem === "Asistencia" ? 'active' : '' }}">Asistencia</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $activeItem === "Memorias" ? 'active' : '' }}">Memorias</a>
                </li>
            </ul>
            @auth
                <form
                    class="d-flex"
                    method="POST"
                    action="{{ route('logout') }}"
                    onsubmit="return confirm('¿Deseas cerrar la sesión?') || event.preventDefault();"
                >
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light">
                        Cerrar sesión
                    </button>
                </form>
            @endauth
        </div>
    </div>
</header>



@if(auth()->user()->hasRole('CoordDist'))
@endif
