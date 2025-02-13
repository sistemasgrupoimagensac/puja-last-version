<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProyectoCliente;
use App\Models\ProyectoCronogramaPago;
use App\Models\TipoDocumento;
use App\Models\TipoUsuario;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user_type' => 'required|integer|in:2,3,4,5',
            'name' => 'required|string|max:250',
            'lastname' => 'required|string|max:250',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|max:20|confirmed',
            'document_type' => 'required|integer|in:1,2,3',
            'phone' => 'required|integer|digits:9',
            'address' => 'required|string|max:255',
            'document_number' => 'required|string|max:30',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'terms' => 'accepted',
        ]);

        $user = User::create([
            'tipo_usuario_id' => $request->user_type,
            'nombres' => $request->name,
            'apellidos' => $request->input('lastname'),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tipo_documento_id' => $request->document_type,
            'celular' => $request->phone,
            'direccion' => $request->address,
            'numero_documento' => $request->document_number,
            'acepta_termino_condiciones' => $request->terms,
        ]);

        $token = $user->createToken($request->email);

        return response()->json([
            'message' => 'Registrado correctamente.',
            'status' => 'success',
            'token' => $token->plainTextToken,
        ]);
    }

    public function show(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id' => 'required|integer|min:1',
        ]);

        $user = User::findOrFail($id);
        $hasPlans = false;
        $projectInfo = false;
        
        $active_plan_users = $user->active_plans()->get();
        $hasPlans = $user->active_plans()->exists();
        $projectInfo = $user->canPublishProjects(); 
        
        return response()->json([
            'message' => 'Perfil de usuario.',
            'status' => 'success',
            'user' => $user,
            'active_plan_users' => $active_plan_users,
            'hasPlans' => $hasPlans,
            'projectInfo' => $projectInfo,
        ]);
    }

    public function userTypes()
    {
        $user_types = TipoUsuario::where('id', '>', 1)->where('id', '<', 5)->get();
        return response()->json([
            'message' => 'Tipos de usuario.',
            'status' => 'success',
            'user_types' => $user_types,
        ]);
    }

    public function tiposDocuemntosIDentidad()
    {
        $document_types = TipoDocumento::where('estado', 1)->get();
        return response()->json([
            'message' => 'Tipos de usuario.',
            'status' => 'success',
            'user_types' => $document_types,
        ]);
    }

    public function sign_in(Request $request)
    {
        $profile_type = $request->input('profile_type', 2);
        switch ( $profile_type ) {
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
                return response()->json([
                    'message' => 'Tipo de perfil no valido.',
                    'status' => 'error',
                ]);
                break;
        }

        return response()->json([
            'message' => 'Iniciar sesion e imagen dedicada.',
            'status' => 'success',
            'profile_type' => $profile_type,
            'imagen_path' => asset($imagen_path),
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if ( $user && (is_null($user->password) || empty($user->password)) ) {
            return response()->json([
                'message' => 'Este usuario fue creado con un inicio de sesión externo (como Google). Por favor, utilice el método de inicio de sesión correspondiente.',
                'status' >= 'error'
            ], 422);
        }

        if ( !$user || !Hash::check($request->input('password'), $user->password) ) {
            return response()->json([
                'message' => 'Las credenciales son incorrectas.',
                'status' => 'error',
            ]);
        }

        $token = $user->createToken($user->email);

        if ( $user->tipo_usuario_id == 5 ) {
            $proyectoCliente = ProyectoCliente::join('proyecto_planes_activos', 'proyecto_clientes.id', '=', 'proyecto_planes_activos.proyecto_cliente_id')
                ->where('proyecto_clientes.user_id', $user->id)
                ->where('proyecto_planes_activos.fecha_inicio', '<=', Carbon::now())
                ->where('proyecto_planes_activos.fecha_fin', '>=', Carbon::now())
                ->select(
                    'proyecto_clientes.id as id',
                    'proyecto_clientes.al_dia as al_dia',
                    'proyecto_clientes.razon_social as razon_social',
                    'proyecto_planes_activos.duracion as periodo_plan',
                    'proyecto_planes_activos.fecha_fin as fecha_fin_contrato',
                    'proyecto_planes_activos.numero_anuncios as numero_anuncios',
                    'proyecto_planes_activos.fecha_inicio as fecha_inicio_contrato',
                )
                ->orderBy('proyecto_planes_activos.fecha_inicio', 'desc')
            ->first();

            if ( $proyectoCliente ) {
                $razonSocial = $proyectoCliente->razon_social;
                $fechaInicio = $proyectoCliente->fecha_inicio_contrato;
                $fechaFin = $proyectoCliente->fecha_fin_contrato;
                $periodoPlan = $proyectoCliente->periodo_plan;
                $numeroAnuncios = $proyectoCliente->numero_anuncios;
                $correo = $user->getEmailAttribute();
                $telefono = $user->getPhoneAttribute();
                $documento = $user->getDniAttribute();
                $tipoDocumento = $user->tipoDocumento->documento;
                $userTypeId = $user->tipoUsuario->id;
                $proyectoClienteId = $proyectoCliente->id;

                if ( !$proyectoCliente->al_dia ) {
                    $primerPago = ProyectoCronogramaPago::where('proyecto_cliente_id', $proyectoCliente->id)
                        ->orderBy('fecha_programada', 'asc')
                    ->first();

                    if ( !$primerPago ) {
                        return response()->json([
                            'message' => 'No se encontró el cronograma de pagos.',
                            'status' => 'error',
                        ], 400);
                    }

                    return response()->json([
                        'message' => 'Credenciales correctas.',
                        'status' => 'success',
                        'token' => $token->plainTextToken,

                        'primer_pago_precio' => $primerPago->monto,
                        'razon_social' => $razonSocial,
                        'correo' => $correo,
                        'telefono' => $telefono,
                        'documento' => $documento,
                        'tipo_documento' => $tipoDocumento,
                        'fecha_inicio' => $fechaInicio,
                        'fecha_fin' => $fechaFin,
                        'periodo_plan' => $periodoPlan,
                        'numero_anuncios' => $numeroAnuncios,
                        'user_tipo_id' => $userTypeId,
                        'proyecto_clienteId' => $proyectoClienteId,
                    ], 200);
                }
            }
        }

        return response()->json([
            'message' => 'Credenciales correctas.',
            'status' => 'success',
            'token' => $token->plainTextToken,
        ]);

    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Se ha enviado el enlace de restablecimiento de contraseña a tu correo.',
                'status' => 'success',
            ], 200);
        }

        return response()->json([
            'message' => 'No se pudo enviar el enlace de restablecimiento. Verifica tu correo.',
            'status' => 'error',
        ], 400);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada.',
            'status' => 'success',
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id' => 'required|integer|min:1',
            'name' => 'required|string|max:250',
            'lastname' => 'required|string|max:255',
            'document_type' => 'required|integer|in:1,2,3',
            'phone' => 'required|integer|digits:9',
            'address' => 'required|string|max:250',
            'document_number' => 'required|string|max:30',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'nombres' => $request->name,
            'apellidos' => $request->lastname,
            'tipo_documento_id' => $request->document_type,
            'celular' => $request->phone,
            'direccion' => $request->address,
            'numero_documento' => $request->document_number,
        ]);

        return response()->json([
            'message' => 'Datos de usuario actualizados.',
            'status' => "success",
            'user' => $user,
        ]);
    }

    public function updatePassword_old(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|max:20|confirmed',
        ]);
    
        $user = User::findOrFail($id);
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'La contraseña actual es incorrecta.',
                'status' => "error",
            ]);
        }
    
        $user->password = Hash::make($request->password);
        $user->save();
    
        return response()->json([
            'message' => 'Contraseña actualizada.',
            'status' => "success",
        ]);
    }

    public function updatePassword(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id' => 'required|integer|min:1',
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|max:20|confirmed',
        ]);
    
        $user = User::findOrFail($request->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'La contraseña actual no es correcta.',
                'status' => "error",
            ]);
        }
    
        $user->password = Hash::make($request->password);
        $user->save();
    
        return response()->json([
            'message' => 'Contraseña actualizada.',
            'status' => "success",
        ]);
    }

    

}
