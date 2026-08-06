<x-layout title="Eventos | Nuevo">
    <x-navbar activeItem="Eventos"/>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <x-titlebar title="Nuevo Evento" />
                <x-breadcrumb backlink="{{ route('events.index') }}" backname="Eventos" activename="Nuevo Evento" />
                <x-card class="mb-3">
                    @if ($errors->any())
                        <x-alert type="danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} </br>
                            @endforeach
                        </x-alert>
                    @endif
                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf
                         <div class="row">
                            <div class="col-md-8 mx-auto">
                                @include('events.form')
                                <button type="submit" class="btn btn-primary btn-lg" >Crear</button>
                            </div>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-layout>
