<x-layout title="Inscripción" >

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <x-card title="Registro de Inscripción" class="mt-5">
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
                        <x-select
                            name="district_id"
                            label="Distrito"
                            placeholder="Seleccione un distrito"
                            required="true"
                            :options="$districts"
                        />
                        <x-select
                            name="event_id"
                            label="Evento"
                            placeholder="Seleccione un evento"
                            required="true"
                        />
                        <x-input type="tel" name="nid" label="No Identificación" value="{{ old('nid','') }}" placeholder="Número de identificación"  />
                        <x-input type="text" name="name" label="Nombre" value="{{ old('name','') }}" placeholder="Nombre completo"  />
                        <x-input type="tel" name="cellphone" label="Teléfono" value="{{ old('cellphone','') }}" placeholder="Número de teléfono"  />
                        <x-input type="email" name="email" label="Correo electrónico" placeholder="tu@correo.com" value="{{ old('email','') }}" />
                        <x-select
                            name="team_id"
                            label="Equipo"
                            placeholder="Seleccione un equipo"
                            :options="$teams"
                        />
                        <hr class="my-4">
                        <button type="submit" class="w-100 btn btn-primary btn-lg" >Registrarse</button>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
    <script>
        window.onload = function () {

            const districtSelect = document.getElementById('district_id');
            const loadEvents = ()=>{
                 const selectedDistrictId = districtSelect.value;
                 const eventSelect = document.getElementById('event_id');
                eventSelect.innerHTML = '<option value="">Seleccione un evento</option>';
                 if (selectedDistrictId) {
                    const url = `/inscriptions/events/${selectedDistrictId}`;
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(event => {
                                eventSelect.innerHTML += `<option value="${event.id}">${event.name}</option>`;
                            });
                        });
                }

            }
            loadEvents();

            districtSelect.addEventListener('change',loadEvents);

        };

    </script>
</x-layout>
