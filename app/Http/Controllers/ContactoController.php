<?php

namespace App\Http\Controllers;
use App\Models\Contacto;
use App\Models\ProyectoLead;
use Hamcrest\Type\IsString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
}
