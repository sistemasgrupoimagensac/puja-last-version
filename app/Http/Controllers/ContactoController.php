<?php

namespace App\Http\Controllers;
use App\Models\Contacto;
use App\Models\Inmueble;
use App\Models\ProyectoLead;
use Hamcrest\Type\IsString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{
    public function index() 
    {
        return view('contacto');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'correo' => 'required|string|email|max:60',
            'telefono' => 'required|string|min:9|max:9|regex:/^9[0-9+\-()\s]*$/',
            'consulta' => 'required|string|max:50',
            'mensaje' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'http_code' => 400,
                'status' => "Error",
                'message' => 'Errores de validación.',
                'errors' => $validator->errors()
            ], 422);
        }

        $contacto = Contacto::create([
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'consulta' => $request->input('consulta'),
            'mensaje' => $request->input('mensaje'),
        ]);

        $this->sendDataToGoogleSheet($contacto);

        return response()->json([
            'http_code' => 200,
            'status' => 'Success',
            'message' => 'Envío de consulta correcto',
        ]);
    }

    public function contacto_proyecto() 
    {
        return view('contacto_proyecto');
    }

    /* public function contacto_lead_proyecto_store(Request $request)
    {
        // Validaciones
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'correo' => 'required|string|email|max:60',
            'telefono' => 'required|string|min:9|max:9|regex:/^9[0-9+\-()\s]*$/', // Ejemplo para teléfonos en Perú (iniciando con 9)
            'mensaje' => 'nullable|string|max:2000',
        ]);

        // Si la validación tiene errores
        if ($validator->fails()) {
            return response()->json([
                'http_code' => 400,
                'status' => "Error",
                'message' => 'Errores de validación.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Guardar en la base de datos con campos adicionales como `estado`, `respondio`, etc.
        ProyectoLead::create([
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'mensaje' => $request->input('mensaje'),
            'estado' => 'sin_contactar', // Se define un valor predeterminado al crear el lead
            'respondio' => false,
            'interesado' => false,
            'fecha_contacto' => null, // Se dejará vacío hasta que se contacte
        ]);

        // Respuesta de éxito
        return response()->json([
            'http_code' => 200,
            'status' => 'Success',
            'message' => 'Envío de consulta correcto',
        ], 200);
    } */

    public function contacto_lead_proyecto_store(Request $request)
    {
        // Validaciones
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'correo' => 'required|string|email|max:60',
            'telefono' => 'required|string|min:9|max:9|regex:/^9[0-9+\-()\s]*$/', // Teléfonos en Perú (iniciando con 9)
            'mensaje' => 'nullable|string|max:2000',
        ]);

        // Si la validación tiene errores
        if ($validator->fails()) {
            return response()->json([
                'http_code' => 400,
                'status' => "Error",
                'message' => 'Errores de validación.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Guardar en la base de datos
        $lead = ProyectoLead::create([
            'nombre' => $request->input('nombre'),
            'correo' => $request->input('correo'),
            'telefono' => $request->input('telefono'),
            'mensaje' => $request->input('mensaje'),
            'estado' => 'sin_contactar', // Valor predeterminado
            'respondio' => false,
            'interesado' => false,
            'fecha_contacto' => null,
        ]);

        // Enviar los datos a Google Sheets
        try {
            $this->sendDataToGoogleSheet($lead);
        } catch (\Exception $e) {
            return response()->json([
                'http_code' => 500,
                'status' => 'Error',
                'message' => 'Error al enviar datos a Google Sheets.',
                'error' => $e->getMessage(),
            ], 500);
        }

        // Respuesta de éxito
        return response()->json([
            'http_code' => 200,
            'status' => 'Success',
            'message' => 'Envío de consulta correcto',
        ], 200);
    }

    private function sendDataToGoogleSheet($lead)
    {
        $scriptUrl = env('SHEET_CONTACTOS_MARIAMELIA');

        $data = [
            'action' => 'addRow',
            'nombres' => $lead->nombre,
            'correo' => $lead->correo,
            'telefono' => $lead->telefono,
            'mensaje' => $lead->mensaje,
        ];

        $response = Http::post($scriptUrl, $data);

        if ($response->failed()) {
            throw new \Exception('Error al enviar datos a Google Sheets.');
        }
    }

    public function whatsappContact(Request $request)
    {
        // Validar los campos que vienen del formulario
        $data = $request->validate([
            'inmueble_id' => 'required|integer',
            'nombre'      => 'required|string',
            'email'       => 'required|email',
            'telefono'    => 'required|string', 
            // ... más campos si deseas
        ]);

        // Buscar el inmueble
        $inmueble = Inmueble::findOrFail($data['inmueble_id']);

        // Obtener el usuario propietario
        $owner = $inmueble->user;  // asumiendo que tu relación se llama "user"

        // El número de celular del propietario
        // Ajusta según el nombre real de tu columna en BD
        $phoneOwner = $owner->celular ?? '51999999999';

        // Crear un mensaje que quieras precargar en el chat:
        $mensaje = "Hola, mi nombre es {$data['nombre']} y estoy interesado en el inmueble ID: {$inmueble->id}.";
        // Agrega todo lo que gustes, por ejemplo su correo y teléfono.
        // $mensaje .= " Mi correo es: {$data['email']} y mi número es: {$data['telefono']}";

        // Retornamos respuesta JSON
        return response()->json([
            'success'         => true,
            'phone'           => $phoneOwner,
            'whatsappMessage' => $mensaje,
        ]);
    }

    public function emailContact(Request $request)
    {
        // Validamos los datos enviados desde el formulario
        $data = $request->validate([
            'inmueble_id' => 'required|integer',
            'nombre'      => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'telefono'    => 'required|string|max:50',
            'mensaje'     => 'required|string',
        ]);

        // Buscamos el inmueble
        $inmueble = Inmueble::findOrFail($data['inmueble_id']);

        // Obtenemos el propietario
        $owner = $inmueble->user; // Ajusta según tu relación

        // Si no tiene un email, retornamos un error
        if (!$owner || !$owner->email) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el correo del propietario.'
            ]);
        }

        // Construimos data adicional para el correo
        $correoPropietario = $owner->email;
        $datosEmail = [
            'nombreRemitente' => $data['nombre'],
            'emailRemitente'  => $data['email'],
            'telefono'        => $data['telefono'],
            'mensaje'         => $data['mensaje'],
            'inmuebleId'      => $inmueble->id,
            // Agrega más datos si lo requieres
        ];

        // Enviamos el correo usando Mail
        try {
            Mail::send('mails.contacto_inmueble', $datosEmail, function($message) use ($correoPropietario) {
                $message->to($correoPropietario)
                    ->subject('Nuevo contacto desde el inmueble');
            });

            return response()->json([
                'success' => true,
                'message' => 'Correo enviado exitosamente.'
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el correo: ' . $e->getMessage()
            ]);
        }
    }
}
