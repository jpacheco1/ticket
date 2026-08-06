<x-layout title="Iniciar Sesión" >
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1 class="h2 text-center mt-3 pt-3 pb-2 border-bottom">Iniciar Sesión</h1>
                <x-card>
                    @if ($errors->any())
                        <x-alert type="danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} </br>
                            @endforeach
                        </x-alert>
                    @endif
                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf
                        <x-input type="email" name="email" label="Correo electrónico" placeholder="tu@correo.com" value="{{ old('email','') }}" />
                        <x-input type="password" name="password" label="Contraseña" placeholder="Contraseña" value="{{ old('password','') }}" />
                        <button type="submit" class="w-100 btn btn-primary btn-lg" >Iniciar Sesión</button>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-layout>
