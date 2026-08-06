<x-layout title="Eventos | Editar">
    <x-navbar activeItem="Eventos"/>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <x-titlebar title="Editar Evento" />
                <x-breadcrumb backlink="{{ route('events.index') }}" backname="Eventos" activename="Editar Evento" />
                <x-card class="mb-3">
                    @if ($errors->any())
                        <x-alert type="danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} </br>
                            @endforeach
                        </x-alert>
                    @endif
                    <form method="POST" action="{{ route('events.update', $event->id) }}">
                        @csrf
                        @method('PUT')
                         <div class="row">
                            <div class="col-md-8 mx-auto">
                                @include('events.form')
                                <button type="submit" class="btn btn-primary btn-lg" >Actualizar</button>
                            </div>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-layout>
