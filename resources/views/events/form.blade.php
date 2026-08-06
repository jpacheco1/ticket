
        <x-input type="text" name="name" label="Nombre" required="true" value="{{ old('name',$event->name ?? '') }}" placeholder="" />
        <x-input type="text" name="place" label="Lugar del evento" required="true" value="{{ old('place',$event->place ?? '') }}" placeholder="" />
        <x-input type="text" name="description" label="Descripción del evento" value="{{ old('description',$event->description ?? '') }}" placeholder="" />
        <x-input type="date" name="start" label="Fecha de Inicio" required="true" value="{{ old('start',$event->start ?? '') }}" placeholder="" />
        <x-input type="date" name="finish" label="Fecha Fin" required="true" value="{{ old('finish',$event->finish ?? '') }}" placeholder="" />
        <x-input type="tel" name="quota_by_district" label="Cupo por Distrito" value="{{ old('quota_by_district',$event->quota_by_district ?? '0') }}" placeholder="" />
        <x-input type="tel" name="quota_additional" label="Cupo Adicional por Distrito" value="{{ old('quota_additional',$event->quota_additional ?? '0') }}" placeholder="" />
        <x-input type="tel" name="quota_max" label="Aforo" required="true" value="{{ old('quota_max',$event->quota_max ?? '0') }}" placeholder="" />
        <x-select
            name="district_id"
            label="Distrito"
            placeholder="Seleccione un distrito"
            required="true"
            :options="$districts"
            selected="{{$event->district_id ?? '' }}"
        />
        <x-select
            name="team_id"
            label="Equipo responsable del evento"
            required="true"
            placeholder="Seleccione un equipo"
            :options="$teams"
            selected="{{$event->team_id ?? '' }}"
        />

