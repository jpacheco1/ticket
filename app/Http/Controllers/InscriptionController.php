<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InscriptionCreated;
use App\Models\Event;
use App\Models\District;
use App\Models\Inscription;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class InscriptionController extends Controller
{
    public function index()
    {
        $districts = District::select('id', 'name')->where('active', true)->get();
        $teams = Team::select('id', 'name')->where('active', true)->get();
        return view('inscriptions', compact('districts', 'teams'));
    }

     public function events($district_id)
    {
        $events = Event::select('id', DB::raw('CONCAT_WS(" ", name, description) as name') )->
                  where('district_id', $district_id)->
                  where('active_inscription', true)->get();
        return response()->json($events, 200);
    }

    public function store(Request $request)
    {
          $request->validate([
                'district_id' => ['required'],
                'event_id' => ['required'],
                'nid' => [
                    'required',
                    'string',
                    'regex:/^[0-9]+$/',
                    'max:20',
                    Rule::unique('inscriptions')->where(function ($query) use ($request) {
                        return $query->where('event_id', $request->event_id)
                                    ->where('email', $request->email);
                    }),
                ],
                'name' => ['required', 'string', 'max:255'],
                'cellphone' => ['required', 'string', 'max:20'],
                'email' => [
                    'required',
                    'string',
                    'lowercase',
                    'email',
                    'max:255'
                ],
                'team_id' => ['required'],
            ], [
                'district_id.required' => 'El Distrito es requerido.',
                'event_id.required' => 'El Evento es requerido.',
                'nid.required' => 'El número de identificación es requerido.',
                'nid.regex' => 'El número de identificación debe contener solo dígitos.',
                'nid.max' => 'El número de identificación no debe tener más de 20 caracteres.',
                'nid.unique' => 'El número de identificación ya está registrado para este evento.',
                'name.required' => 'El Nombre es requerido.',
                'cellphone.required' => 'El Teléfono es requerido.',
                'email.required' => 'El Correo electrónico es requerido.',
                'team_id.required' => 'El Equipo es requerido.',
            ]
        );

        $count_event = Inscription::where('event_id', $request->event_id)->count();
        $count_district = Inscription::where('event_id', $request->event_id)
            ->where('district_id', $request->district_id)
            ->count();
        $event = Event::find($request->event_id);
        $quota_district = (int) $event->quota_by_district;
        $quota_additional = (int) $event->quota_additional;


        if ($count_event < $event->quota_max) {
            if($count_district >= ($quota_district + $quota_additional)) {
                return redirect()->back()->withErrors(['district_id' => 'El distrito ha alcanzado el límite máximo de inscripciones para este evento.']);
            }
        }else{
            return redirect()->back()->withErrors(['event_id' => 'El evento ha alcanzado el límite máximo de inscripciones.']);
        }


        $request->merge([
            'additional' => 0,
            'user_id' => '1',
        ]);

        $inscription = Inscription::create($request->all());

        Mail::to($inscription->email)->send(new InscriptionCreated($inscription));

        return redirect()->route('inscriptions.index')->with('success', 'Inscripción creada con éxito');
    }

    public function generarTicket($id)
    {
        $inscription_id = explode('-', $id)[0] ?? null;
        $event_id = explode('-', $id)[1] ?? null;
        $nid = explode('-', $id)[2] ?? null;

        if (!$inscription_id || !$event_id || !$nid) {
            abort(404);
        }

        // Código de barras
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($nid, $generator::TYPE_CODE_39));

        // Logo
        $logoPath = asset('images/logo-'.$event_id.'.webp');
        $logoBase64 = base64_encode(file_get_contents($logoPath));

        $data = Inscription::select(
            'inscriptions.name',
            'inscriptions.nid',
            'events.description as event_description',
            'teams.name as team_name'
            )->
                join('events', 'inscriptions.event_id', '=', 'events.id')->
                join('teams', 'inscriptions.team_id', '=', 'teams.id')->
                where('inscriptions.id', $inscription_id)->
                first();

        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d H:i:s');

        $pdf = Pdf::loadView('pdfs.ticket_created',compact('data','barcode','logoBase64','date'));
        return $pdf->stream('ticket.pdf');
    }
}
