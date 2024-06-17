<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'signin_email' => 'required|email',
            'signin_password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request['signin_email'])->first();

        if ($user && Hash::check($request['signin_password'], $user->password)) {
            // dd("Entraste Logueado");
            Auth::login($user);
            return redirect()->intended('/');
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_usuario_id' => 'required|string|max:255',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'tipo_documento_id' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'imagen' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'acepta_termino_condiciones' => 'required|string|max:255',
            'acepta_confidencialidad' => 'required|string|max:255',
        ]);

        $user = User::create([
            'tipo_usuario_id' => $request->input('tipo_usuario_id'),
            'codigo_unico' => $request->input('nombres'),
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('nombres'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'tipo_documento_id' => $request->input('nombres'),
            'celular' => $request->input('nombres'),
            'imagen' => $request->input('nombres'),
            'estado' => $request->input('nombres'),
            'acepta_termino_condiciones' => $request->input('nombres'),
            'acepta_confidencialidad' => $request->input('nombres'),
        ]);

        // Puedes hacer otras operaciones, como enviar correos electrónicos de confirmación, iniciar sesión automática, etc.

        // Redirigir a alguna página después de la creación exitosa
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Manejar el cierre de sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/sign-in');
    }
}
