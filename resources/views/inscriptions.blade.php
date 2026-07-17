<x-layout title="Register" >

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h4 class="text-center">Inscripción</h4>
                <hr class="my-4">
                <form method="POST" action="{{ route('inscriptions.store') }}">
                    @csrf
                    <div class="col-md-6">
                        <x-select
                            name="district_id"
                            label="Distrito"
                            placeholder="Seleccione un distrito"
                            :options="$districts"
                        />
                    </div>
                    <div class="col-md-6">
                        <x-select
                            name="event_id"
                            label="Evento"
                            placeholder="Seleccione un evento"
                        />
                    </div>
                    <x-input type="tel" name="nid" label="No Identificación" value="{{ old('nid') }}" placeholder="Número de identificación"  />
                    <x-input type="text" name="name" label="Nombre" value="{{ old('name') }}" placeholder="Nombre completo"  />
                    <x-input type="tel" name="cellphone" label="Teléfono" value="{{ old('cellphone') }}" placeholder="Número de teléfono"  />
                    <x-input type="email" name="email" label="Correo electrónico" placeholder="tu@correo.com" value="{{ old('email') }}" />
                    <x-select
                        name="team_id"
                        label="Equipo"
                        placeholder="Seleccione un equipo"
                        :options="$teams"
                    />
                    <hr class="my-4">
                    <button type="submit" class="w-100 btn btn-primary btn-lg" >Registrarse</button>
                </form>
            </div>
        </div>
    </div>
    <script>

        const districtSelect = document.getElementById('district_id');
        districtSelect.addEventListener('change', function () {
            const selectedDistrictId = this.value;
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

        });
    </script>
</x-layout>
