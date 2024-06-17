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
        /* $request->validate([
            'tipo_usuario_id' => 'required|integer|between:0,9',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'tipo_documento_id' => 'required|integer|max:1',
            'celular' => 'integer|digits:9',
            'numero_documento' => 'string|max:30',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'estado' => 'required|boolean',
            'acepta_termino_condiciones' => 'required|boolean',
            'acepta_confidencialidad' => 'required|boolean',
        ]); */

        $validator = Validator::make($request->all(), [
            'tipo_usuario_id' => 'required|integer|between:0,9',
            'codigo_unico' => 'required|string|max:255|unique:users',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'tipo_documento_id' => 'required|integer|max:1',
            'celular' => 'integer|digits:9',
            'numero_documento' => 'required|string|max:30|unique:users',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'estado' => 'required|boolean',
            'acepta_termino_condiciones' => 'required|boolean',
            'acepta_confidencialidad' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'tipo_usuario_id' => $request->input('tipo_usuario_id'),
            'codigo_unico' => $request->input('codigo_unico'),
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('apellidos'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'tipo_documento_id' => $request->input('tipo_documento_id'),
            'numero_documento' => $request->input('numero_documento'),
            'celular' => $request->input('celular'),
            // 'imagen' => $request->input('imagen'),
            'estado' => 1,
            'acepta_termino_condiciones' => true,
            'acepta_confidencialidad' => true,
        ]);
        if ($request->hasFile('imagen')) {
            $imageName = time().'.'.$request->imagen->extension();  
            $request->imagen->move(public_path('images'), $imageName);
            $user->imagen = $imageName;
            $user->save();
        }
        return response()->json(['message' => 'Usuario creado exitosamente', 'user' => $user], 201);

        // Puedes hacer otras operaciones, como enviar correos electrónicos de confirmación, iniciar sesión automática, etc.

        // Redirigir a alguna página después de la creación exitosa
        // return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Manejar el cierre de sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/sign-in');
    }
}
