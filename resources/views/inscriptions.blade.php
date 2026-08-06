<x-layout title="Inscripción" >
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <h1 class="h2 text-center mt-3 pt-3 pb-2 border-bottom">Inscribirse</h1>
                <x-card class="mt-3 mb-3">
                    @if (session('success'))
                        <x-alert type="success">
                            {{ session('success') }}
                        </x-alert>
                    @endif
                    @if ($errors->any())
                        <x-alert type="danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} </br>
                            @endforeach
                        </x-alert>
                    @endif
                     <form method="POST" action="{{ route('inscriptions.store') }}">
                        @csrf
                        <x-input type="hidden" name="additional" value="0" />
                        <x-select
                            name="event_id"
                            label="Evento"
                            placeholder="Seleccione un evento"
                            required="true"
                            :options="$events"
                        />

                        <x-input type="tel" name="nid" label="No Identificación" value="{{ old('nid','') }}" placeholder="Número de identificación"  required="true"/>
                        <x-input type="text" name="name" label="Nombre" value="{{ old('name','') }}" placeholder="Nombre completo"  required="true"/>
                        <x-input type="tel" name="cellphone" label="Teléfono" value="{{ old('cellphone','') }}" placeholder="Número de teléfono"  required="true"/>
                        <x-input type="email" name="email" label="Correo electrónico" placeholder="tu@correo.com" value="{{ old('email','') }}" required="true"/>
                        <x-select
                            name="team_id"
                            label="Equipo"
                            placeholder="Seleccione un equipo"
                            :options="$teams"
                            required="true"
                        />
                        <x-select
                            name="district_id"
                            label="Distrito"
                            placeholder="Seleccione un distrito"
                            required="true"
                            :options="$districts"
                        />
                        <button type="submit" class="w-100 btn btn-primary btn-lg" >Inscribirse</button>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-layout>
