<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProyectoCliente;
use App\Models\ProyectoCronogramaPago;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            // 'tipo_de_usuario' => 'required|integer',
            // 'apellido' => 'required|string|max:250',
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:6|max:20|confirmed',
            // 'tipo_documento' => 'required|integer|in:1,2,3',
            // 'telefono' => 'required|integer|digits:9',
            // 'direccion' => 'required|string|max:255',
            // 'numero_de_documento' => 'required|string|max:30',
            // 'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'terminos' => 'accepted',
        ]);

        $user = User::create([
            'nombres' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken($request->email);

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];




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



    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $response[] = ['opracion' => 'Cierre de sesion'];

        return response()->json($response);

    }

}
