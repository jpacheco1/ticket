<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\District;
use App\Models\Team;
use App\Models\Inscription;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    function index()
    {
        return view('events.index');
    }

    public function jsondata(Request $request)
    {
        // session user
        $user = Auth::user();
        $district_id = (int) $user->district_id;

        $columns = ['events.name', 'events.place', 'events.district_id'];
        $search = $request->query('search') ?? '';

        $events = Event::select(
            'events.id',
            'events.name',
            'events.place',
            'events.description',
            'events.start',
            'events.finish',
            'events.quota_by_district',
            'events.quota_additional',
            'events.quota_max',
            'events.active',
            'events.district_id',
            'teams.name as team_name',
            'users.name as user_name'
        )
        ->join('teams', 'teams.id', '=', 'events.team_id')
        ->join('users', 'users.id', '=', 'events.user_id')
        ->when($district_id < 36, function ($query) use ($district_id) {
            return $query->where('events.district_id', $district_id);
        })
        ->where(function ($query) use ($search, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', "%{$search}%");
            }
        })
        ->orderBy('events.id', 'desc')
        ->paginate(10);
        return response()->json($events);

    }

    public function active($id)
    {
        $user = Event::find($id);
        $user->active = !$user->active;
        $user->save();
        return redirect()->route('events.index')->with('success', 'Estado actualizado con éxito');
    }

    public function create(){
         // session user
        $user = Auth::user();
        $district_id = (int) $user->district_id;

        $teams = Team::select('id', 'name')->where('active', true)->get();
        $districts = [['id'=>$district_id, 'name'=>'Distrito '.$district_id]];

        if($district_id==36){
            $districts = District::select('id', 'name')->where('active', true)->get();
        }

        return view('events.create', compact('districts', 'teams'));
    }

    public function store(Request $request)
    {

        $request->validate([

                'name' => ['required', 'string', 'max:255'],
                'place' => ['required', 'string', 'max:255'],
                'start' => ['required', 'date'],
                'finish'  => ['required', 'date', 'after_or_equal:start'],
                'quota_by_district' => ['nullable', 'numeric'],
                'quota_additional' => ['nullable', 'numeric'],
                'quota_max' => ['required', 'numeric'],
                'district_id' => ['required'],
                'team_id' => ['required'],
            ], [

                'name.required' => 'El Nombre es requerido.',
                'place.required' => 'El Lugar es requerido.',
                'start.required' => 'La Fecha de Inicio es requerida.',
                'finish.required' => 'La Fecha de Fin es requerida.',
                'finish.after_or_equal' => 'La Fecha de Fin debe ser igual o posterior a la Fecha de Inicio.',
                'quota_by_district.numeric' => 'El cupo por Distrito debe ser un número.',
                'quota_additional.numeric' => 'El cupo Adicional debe ser un número.',
                'quota_max.numeric' => 'El cupo Máximo debe ser un número.',
                'district_id.required' => 'El Distrito es requerido.',
                'team_id.required' => 'El Equipo es requerido.',
            ]
        );

        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);

        $event = Event::create($request->all());
        return redirect()->route('events.index')->with('success', 'Evento creado con éxito');
    }

    public function edit($id)
    {
        // session user
        $user = Auth::user();
        $district_id = (int) $user->district_id;

        $teams = Team::select('id', 'name')->where('active', true)->get();
        $districts = [['id'=>$district_id, 'name'=>'Distrito '.$district_id]];
        if($district_id==36){
            $districts = District::select('id', 'name')->where('active', true)->get();
        }

        $event = Event::findOrFail($id);

        return view('events.edit', compact('event', 'teams', 'districts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

                'name' => ['required', 'string', 'max:255'],
                'place' => ['required', 'string', 'max:255'],
                'start' => ['required', 'date'],
                'finish'  => ['required', 'date', 'after_or_equal:start'],
                'quota_by_district' => ['nullable', 'numeric'],
                'quota_additional' => ['nullable', 'numeric'],
                'quota_max' => ['required', 'numeric'],
                'district_id' => ['required'],
                'team_id' => ['required'],
            ], [

                'name.required' => 'El Nombre es requerido.',
                'place.required' => 'El Lugar es requerido.',
                'start.required' => 'La Fecha de Inicio es requerida.',
                'finish.required' => 'La Fecha de Fin es requerida.',
                'finish.after_or_equal' => 'La Fecha de Fin debe ser igual o posterior a la Fecha de Inicio.',
                'quota_by_district.numeric' => 'El cupo por Distrito debe ser un número.',
                'quota_additional.numeric' => 'El cupo Adicional debe ser un número.',
                'quota_max.numeric' => 'El cupo Máximo debe ser un número.',
                'district_id.required' => 'El Distrito es requerido.',
                'team_id.required' => 'El Equipo es requerido.',
            ]
        );

        $event = Event::findOrFail($id);
        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito');
    }

    public function destroy($id)
    {
        $inscriptionsCount = Inscription::where('event_id', $id)->count();
        if ($inscriptionsCount > 0) {
            return redirect()->route('events.index')->with('error', 'No se puede eliminar el evento porque tiene inscripciones asociadas.');
        }

        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Evento eliminado con éxito');
    }
}
