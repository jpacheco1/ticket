<x-layout title="Inscripciones | Nueva">
    <x-navbar activeItem="Eventos"/>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
            <x-titlebar title="Nueva Inscripción" />
            <x-breadcrumb backlink="{{ route('inscriptions.index', ['event_id' => $event_id]) }}" backname="Inscripciones" activename="Nueva Inscripción" />
            <x-card class="mt-3">
                @if ($errors->any())
                    <x-alert type="danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }} </br>
                        @endforeach
                    </x-alert>
                @endif
                <form method="POST" action="{{ route('inscriptions.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            @include('inscriptions.form')
                            <button type="submit" class="btn btn-primary btn-lg" >Crear</button>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-layout>
