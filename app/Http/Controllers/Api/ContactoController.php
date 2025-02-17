<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inmueble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{

    public function emailContact(Request $request)
    {
        $data = $request->validate([
            'inmueble_id' => 'required|integer',
            'nombre'      => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'telefono'    => 'required|string|max:50',
            'mensaje'     => 'required|string',
        ]);

        $inmueble = Inmueble::findOrFail($data['inmueble_id']);
        $owner = $inmueble->user;

        if (!$owner || !$owner->email) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el correo del propietario.'
            ]);
        }

        $correoPropietario = $owner->email;
        $datosEmail = [
            'nombreRemitente' => $data['nombre'],
            'emailRemitente'  => $data['email'],
            'telefono'        => $data['telefono'],
            'mensaje'         => $data['mensaje'],
            'inmuebleId'      => $inmueble->id,
        ];

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
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el correo: ' . $e->getMessage()
            ]);
        }
    }

    public function whatsappContact(Request $request)
    {
        $data = $request->validate([
            'inmueble_id' => 'required|integer',
            'nombre'      => 'required|string',
            'email'       => 'required|email',
            'telefono'    => 'required|string',
        ]);

        $inmueble = Inmueble::findOrFail($data['inmueble_id']);
        $owner = $inmueble->user;
        $phoneOwner = $owner->celular ?? '51999999999';

        $mensaje = "Hola, mi nombre es {$data['nombre']} y estoy interesado en el inmueble ID: {$inmueble->id}.";

        return response()->json([
            'success'         => true,
            'phone'           => $phoneOwner,
            'whatsappMessage' => $mensaje,
        ]);
    }
}
