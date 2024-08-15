<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function sign_in(Request $request)
    {
        if ($request->has('profile_type')) {
            $profile_type = $request->query('profile_type');
        } else {
            $profile_type = 2;
        }
        switch ($profile_type) {
            case '2':
                $imagen_path = "/images/bg5.webp";
                break;
            case '3':
                $imagen_path = "/images/sigin_corredor.webp";
                break;
            case '4':
                $imagen_path = "/images/signin5.webp";
                break;
            default:
                return view('publicatuinmueble');
                break;
        }
        session(['profile_type' => $profile_type]);
        return view('auth.signin', compact('profile_type', 'imagen_path'));
    }

    public function register(Request $request)
    {
        if ($request->session()->has('profile_type')) {
            $profile_type = $request->session()->get('profile_type');
            $user_types = TipoUsuario::where('id', '>', 1)->get();
        } else {
            return view('publicatuinmueble');
        }
        return view('auth.register', compact('profile_type', 'user_types'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'user_type' => 'required|integer|between:0,6',
            'user_type' => 'required|string',
            'signin_email' => 'required|email',
            'signin_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request['signin_email'])->first();

        if ($user && Hash::check($request['signin_password'], $user->password)) {
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
            // 'user_type' => 'required|integer|between:0,9',
            'user_type' => 'required|string',
            // 'unique_code' => 'required|string|max:255|unique:users,codigo_unico',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:20',
            'document_type' => 'required|integer|max:1',
            'phone' => 'integer|digits:9',
            'address' => 'required|string',
            'document_number' => 'required|string|max:30',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            // 'estado' => 'required|boolean',
            'accept_terms' => 'accepted',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        $user_type = $request->user_type;
        if ( !is_numeric($user_type) ) {
            if($user_type === "owner") {
                $user_type = 2;
            } else if ($user_type === "broker" ) {
                $user_type = 5;
            } else if ($user_type === "project" ) {
                $user_type = 4;
            }
        }

        $acceptTerms = $request->has('accept_terms') ? true : false;
        $acceptConfid = $request->has('accept_confid') ? true : false;

        $user = User::create([
            'tipo_usuario_id' => $user_type,
            'codigo_unico' => null,
            'nombres' => $request->input('name'),
            'apellidos' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'tipo_documento_id' => $request->input('document_type'),
            'celular' => $request->input('phone'),
            'numero_documento' => $request->input('document_number'),
            // 'imagen' => $request->input('imagen'),
            'estado' => 1,
            'acepta_termino_condiciones' => $acceptTerms,
            'direccion' => $request->input('address'),
        ]);
        if ($request->hasFile('imagen')) {
            $imageName = time().'.'.$request->imagen->extension();  
            $request->imagen->move(public_path('images'), $imageName);
            $user->imagen = $imageName;
            $user->save();
        }
        Auth::login($user);
        return redirect()->intended('/');
        // return response()->json(['message' => 'Usuario creado exitosamente', 'user' => $user], 201);

    }

    // actualizar registro de usuario logueado con Google
    public function complete_user_google(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'tipo_documento' => 'required|in:1,2,3',
            'numero_de_documento' => 'required|string|max:30|unique:users,numero_documento',
            'telefono' => 'required|string|min:9|max:9|regex:/^9[0-9+\-()\s]*$/',
            'direccion' => 'required|string|max:150',
            'accept_terms' => 'accepted',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'http_code' => 400,
                'status' => "Error",
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }
    
        if (!Auth::check()) {
            return redirect()->route('sign_in')->with('error', 'Inicia sesión, por favor.');
        }

        $user_id = auth()->id();
        $user = User::findOrFail($user_id);
        
        $user->update([
            'tipo_documento_id' => $request->input('tipo_documento'),
            'numero_documento' => $request->input('numero_de_documento'),
            'celular' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'acepta_termino_condiciones' => $request->input('accept_terms'),
        ]);

        return response()->json([
            'http_code' => 200,
            'status' => "Success",
            'message' => 'Actualización correcta',
            'error' => false
        ], 200);

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}