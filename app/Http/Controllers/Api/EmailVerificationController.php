<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function send (Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $user = User::findOrFail($request->user_id);

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'El usuario ya ha verificado su correo.'], 400);
        }

        $user->sendEmailVerificationNotification();
        return response()->json(['message' => 'Correo de verificación enviado con éxito.']);
    }
}
