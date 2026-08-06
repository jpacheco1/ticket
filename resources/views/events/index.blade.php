
<x-layout title="Eventos" >
    <x-navbar activeItem="Eventos"/>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <x-titlebar title="Eventos">
                    <a  href="{{ route('events.create') }}" type="button" class="btn btn-sm btn-outline-success">
                        Nuevo Evento +
                    </a>
                </x-titlebar>
                <x-breadcrumb backlink="/dashboard" backname="Inicio" activename="Eventos" />
                <x-card class="mt-3">
                    @if (session('success'))
                        <x-alert type="success">
                            {{ session('success') }}
                        </x-alert>
                    @elseif(session('error'))
                        <x-alert type="danger">
                            {{ session('error') }}
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
                                        Nombre del evento
                                    </th>
                                    <th scope="col">
                                        <span class="text-danger">*</span>
                                        Lugar
                                    </th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">
                                        <span class="text-danger">*</span>
                                        Distrito
                                    </th>
                                    <th scope="col">Cupos</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Sesiones</th>
                                    <th scope="col">Inscritos</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="10" class="text-center">No hay items disponibles...</td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <ul id="pagination-controls" class="pagination justify-content-end">
                            </ul>
                        </div>
                        </div>
                    </div>
                </x-card>

            </div>
        </div>
    </div>
</x-layout>
<script>

    function renderPagination(data) {
    const controls = document.getElementById('pagination-controls');

    let html = '';

    // Botón Anterior
    if (data.prev_page_url) {
        html += `<button onclick="fetchUsers(${data.current_page - 1})">Anterior</button>`;
    }

    // Indicador de página
    html += ` <span>Página ${data.current_page} de ${data.last_page}</span> `;

    // Botón Siguiente
    if (data.next_page_url) {
        html += `<button onclick="fetchUsers(${data.current_page + 1})">Siguiente</button>`;
    }

    controls.innerHTML = html;
}

    function dataTable(url) {
        const table = document.getElementById('table');
        if (table) {
            const tbody = table.querySelector('tbody');
            tbody.innerHTML = `<tr><td colspan="10" class="text-center">Cargando...</td></tr>`;

            fetch(url)
            .then(response => response.json())
            .then(({ data, to, total }) => {
                tbody.innerHTML = ``;
                if (data.length > 0) {

                    data.forEach((item, index) => {
                        const row  = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>
                                    <strong>${item.name}</strong>
                                    <p>${item.description ?? ''}</p>
                                </td>
                                <td>${item.place}</td>
                                <td>${item.start == item.finish ? item.start : item.start+' - '+item.finish}</td>
                                <td>${item.district_id}</td>
                                <td>${item.quota_max}</td>
                                <td>
                                    <form action="/events/active/${item.id}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm ${item.active ? 'btn-success' : 'btn-danger'}">
                                            ${item.active ? '<i class="fa-solid fa-circle-check"></i>' : '<i class="fa-solid fa-circle-stop"></i>'}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-table-list"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/events/${item.id}/inscriptions" class="btn btn-sm btn-info">
                                        <i class="fa-solid fa-table-list"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/events/edit/${item.id}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="/events/${item.id}" method="POST" style="display:inline;"
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

    const  url = `/events/jsondata`;
    dataTable(url);


    const searchButton = document.getElementById('searchButton');
       let searchInput = document.getElementById('searchInput');
    searchButton.addEventListener('click',function (event) {
        let searchTerm = searchInput.value.trim();
        const url = `/events/jsondata?search=${encodeURIComponent(searchTerm)}`;
        dataTable(url);
    });

    searchInput.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            let searchTerm = searchInput.value.trim();
            const url = `/events/jsondata?search=${encodeURIComponent(searchTerm)}`;
            dataTable(url);
        }
    });

</script>
