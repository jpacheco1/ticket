
<x-layout title="Eventos" >
    <x-navbar activeItem="Eventos"/>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <x-titlebar title="Inscripciones">
                    <a  href="{{ route('inscriptions.create', ['event_id' => $event->id]) }}" type="button" class="btn btn-sm btn-outline-success">
                        Nueva Inscripción +
                    </a>
                </x-titlebar>
                <x-breadcrumb backlink="{{ route('events.index') }}" backname="Eventos" activename="Inscripciones" />
                <input type="hidden" id="event_id" value="{{ $event->id }}">
                <div class="row row-cols-1 row-cols-md-3 mt-3 text-center">
                    <div class="col">
                        <x-card class="mb-3">
                            <h4 class="my-0 fw-normal">Cupo Total</h4>
                            <h1 class="card-title pricing-card-title">
                                {{ $inscriptions_count }}<small class="text-body-secondary fw-light">/{{ $event->quota_max }}</small>
                            </h1>
                        </x-card>
                    </div>
                    <div class="col">
                        <x-card class="mb-3">
                            <h4 class="my-0 fw-normal">Cupo Distrito</h4>
                            <h1 class="card-title pricing-card-title">
                                {{ $event->quota_by_district }}
                            </h1>
                        </x-card>
                    </div>
                    <div class="col">
                        <x-card class="mb-3">
                            <h4 class="my-0 fw-normal">Cupo Adicional Distrito</h4>
                            <h1 class="card-title pricing-card-title">
                                {{ $inscriptions_additional_count }}<small class="text-body-secondary fw-light">/{{ $event->quota_additional }}</small>
                            </h1>
                        </x-card>
                    </div>
                </div>

                <x-card class="mt-3">
                    @if (session('success'))
                        <x-alert type="success">
                            {{ session('success') }}
                        </x-alert>
                    @endif
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="searchInput" placeholder="Buscar...">
                        <button class="btn btn-outline-secondary" id="searchButton" >Buscar</button>
                    </div>
                    <div  class="table-responsive">
                        <table id="table" class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        <span class="text-danger">*</span>
                                        Cédula
                                    </th>
                                    <th scope="col">
                                        <span class="text-danger">*</span>
                                        Nombre
                                    </th>
                                    <th scope="col">
                                        <span class="text-danger">*</span>
                                        Email
                                    </th>
                                    <th scope="col">Equipo</th>
                                    <th scope="col">
                                        Cupo Adicional
                                    </th>
                                    <th scope="col">Ticket</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8" class="text-center">No hay items disponibles...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </x-card>

            </div>
        </div>
    </div>
</x-layout>
<script>

    function dataTable(url) {
        const table = document.getElementById('table');
        if (table) {
            const tbody = table.querySelector('tbody');
            tbody.innerHTML = `<tr><td colspan="8" class="text-center">Cargando...</td></tr>`;

            fetch(url)
            .then(response => response.json())
            .then(({ data, to, total }) => {
                tbody.innerHTML = ``;
                'inscriptions.id',
            'inscriptions.cellphone',
            'inscriptions.additional',
            'inscriptions.created_at',
            'teams.name as team'
                if (data.length > 0) {

                    data.forEach((item, index) => {
                        const row  = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.nid}</td>
                                <td>${item.name}</td>
                                <td>${item.email}</td>
                                <td>${item.team}</td>
                                <td>${item.additional == '1' ? 'Sí' : 'No'}</td>
                                <td>
                                    <a href="/inscriptions/ticket/${item.id}-${item.event_id}-${item.nid}" target="_blank" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-ticket"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/inscriptions/edit/${item.id}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/inscriptions/${item.id}" method="POST" style="display:inline;"
                                     onsubmit="return confirm('¿Desea eliminar este registro?') || event.preventDefault();">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });

                } else {
                    tbody.innerHTML = `<tr><td colspan="7" class="text-center">No hay resultados disponibles...</td></tr>`;
                }
            });

        }
    }
    let eventId = document.getElementById('event_id').value;
    const  url = `/events/${eventId}/inscriptions/jsondata`;
    dataTable(url);

    const searchButton = document.getElementById('searchButton');
       let searchInput = document.getElementById('searchInput');
    searchButton.addEventListener('click',function (event) {
        let searchTerm = searchInput.value.trim();
        const url = `/events/${eventId}/inscriptions/jsondata?search=${encodeURIComponent(searchTerm)}`;
        dataTable(url);
    });

    searchInput.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            let searchTerm = searchInput.value.trim();
            const url = `/events/${eventId}/inscriptions/jsondata?search=${encodeURIComponent(searchTerm)}`;
            dataTable(url);
        }
    });
</script>
