<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\District;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

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
        $events = Event::select('id', DB::raw('CONCAT_WS(" ", name, description) as name') )->where('district_id', $district_id)->where('active', true)->get();
        return response()->json($events, 200);
    }

    public function store(Request $request)
    {
         $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],[
                "email.required" =>"El correo electrónico es requerido.",
                "password.required" =>"La contraseña es requerida.",
            ]
        );

    }
}
