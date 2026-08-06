<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('auth/login');
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

        //Valido que esté activo
        $user = User::where('email',$request->email)
                ->where('active','1')
                ->first() ?? null;

        if(!$user){
            return back()->withErrors([
                'email' => 'Ha ocurrido un error. Consulte al administrador para más información',
            ])->onlyInput('email');
        }


        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no son correctas.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
