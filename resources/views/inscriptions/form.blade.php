
        <x-input type="hidden" name="event_id" value="{{ $event_id ?? '' }}" />
        <x-select
            name="district_id"
            label="Distrito"
            placeholder="Seleccione un distrito"
            required="true"
            :options="$districts"
            selected="{{$inscription->district_id ?? '' }}"
        />

        <x-input type="tel" name="nid" label="No Identificación" value="{{ old('nid',$inscription->nid ?? '') }}" placeholder="Número de identificación"  />
        <x-input type="text" name="name" label="Nombre" value="{{ old('name',$inscription->name ?? '') }}" placeholder="Nombre completo"  />
        <x-input type="tel" name="cellphone" label="Teléfono" value="{{ old('cellphone',$inscription->cellphone ?? '') }}" placeholder="Número de teléfono"  />
        <x-input type="email" name="email" label="Correo electrónico" placeholder="tu@correo.com" value="{{ old('email',$inscription->email ?? '') }}" />
        <x-select
            name="team_id"
            label="Equipo"
            placeholder="Seleccione un equipo"
            :options="$teams"
            selected="{{$inscription->team_id ?? '' }}"
        />
        <x-select
            name="additional"
            label="Cupo Adicional"
            placeholder="Seleccione una opción"
            :options="$additionals"
            selected="{{$inscription->additonal ?? '0' }}"
        />
