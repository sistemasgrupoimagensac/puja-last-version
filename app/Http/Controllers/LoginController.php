<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    public function select_profile()
    {
        return view('publicatuinmueble');
    }

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
        // Validación inicial de los campos del formulario
        $validator = Validator::make($request->all(), [
            'user_type' => 'required|string',
            'correo' => 'required|email',
            'contraseña' => 'required',
        ]);
    
        // Si la validación falla, devuelve los errores
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Buscar al usuario por correo electrónico
        $user = User::where('email', $request->input('correo'))->first();
    
        // Validar si el usuario existe en la base de datos
        if (!$user) {
            return response()->json([
                'message' => 'El correo electrónico no está registrado.',
                'errors' => [
                    'correo' => ['El correo electrónico no está registrado.']
                ]
            ], 422);
        }
    
        // Verificar si el usuario tiene una contraseña en la base de datos
        if (is_null($user->password) || empty($user->password)) {
            return response()->json([
                'message' => 'Este usuario fue creado con un inicio de sesión externo (como Google). Por favor, utilice el método de inicio de sesión correspondiente.',
                'errors' => [
                    'correo' => ['El usuario debe iniciar sesión con su cuenta de Google.']
                ]
            ], 422);
        }
    
        // Verificar si la contraseña es correcta
        if (!Hash::check($request->input('contraseña'), $user->password)) {
            return response()->json([
                'message' => 'La contraseña es incorrecta.',
                'errors' => [
                    'contraseña' => ['La contraseña es incorrecta.']
                ]
            ], 422);
        }
    
        // Si las credenciales son correctas, iniciar sesión
        Auth::login($user);
    
        // Redireccionar al usuario a la página de inicio
        return response()->json([
            'message' => 'Inicio de sesión exitoso.',
            'redirect' => redirect()->intended(route('panel.mis-avisos'))->getTargetUrl(),
        ]);
    }    

    public function store(Request $request)
    {
        // Validación de los campos del formulario de registro
        $validator = Validator::make($request->all(), [
            'tipo_de_usuario' => 'required|string',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'contraseña' => 'required|string|min:6|max:20',
            'tipo_documento' => 'required|integer|in:1,2,3',
            'telefono' => 'required|integer|digits:9',
            'direccion' => 'required|string|max:255',
            'numero_de_documento' => 'required|string|max:30|unique:users,numero_documento',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'terminos' => 'accepted',
        ]);

        // Manejo de errores de validación
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        // Asignación del tipo de usuario (conversión de cadenas a enteros)
        $user_type = $request->input('tipo_de_usuario');
        if (!is_numeric($user_type)) {
            switch ($user_type) {
                case "owner":
                    $user_type = 2;
                    break;
                case "broker":
                    $user_type = 5;
                    break;
                case "project":
                    $user_type = 4;
                    break;
                default:
                    return response()->json([
                        'message' => 'Tipo de usuario no válido',
                        'errors' => ['tipo_de_usuario' => ['El tipo de usuario no es válido']]
                    ], 422);
            }
        }

        // Creación del nuevo usuario
        $user = User::create([
            'tipo_usuario_id' => $user_type,
            'codigo_unico' => null,
            'nombres' => $request->input('nombre'),
            'apellidos' => $request->input('apellido'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('contraseña')),
            'tipo_documento_id' => $request->input('tipo_documento'),
            'celular' => $request->input('telefono'),
            'numero_documento' => $request->input('numero_de_documento'),
            'estado' => 1,
            'acepta_termino_condiciones' => $request->boolean('terminos'),
            'direccion' => $request->input('direccion'),
        ]);

        // Manejo de la imagen del usuario
        if ($request->hasFile('imagen')) {
            $imageName = time() . '.' . $request->imagen->extension();
            $request->imagen->move(public_path('images'), $imageName);
            $user->update(['imagen' => $imageName]);
        }

        // Autenticación y evento de registro
        Auth::login($user);
        event(new Registered($user));

        // Redirección a la página de inicio
        return redirect('/');
    }

    public function forgot_password(Request $request)
    {
        return view('auth.recoverpassword');
    }

    public function send_password(Request $request)
    {
        // dd($request->all());
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function recovery_password(Request $request, string $token)
    {
        // dd($request->all());
        return view('auth.reset-password', ['token' => $token, 'email' => $request->get('email', '')]);
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
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

        $user_id = Auth::id();
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
            'message' => 'Actualización del perfil correcta',
            'error' => false
        ], 200);

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}