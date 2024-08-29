<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SuppliersController extends Controller
{
    public function selectAccountGoogle() {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();   
    }
    
    public function createLoginGoogle() {
        $user_google = Socialite::driver('google')->user();
        $profile_type = session('profile_type', 2); 
        $existingUser = User::where('google_id', $user_google->id)->first();

        if ($existingUser) {
            // Loguear al usuario existente
            Auth::login($existingUser);
            return redirect('/')->with('user', $existingUser->toJson());
        } else {
            // Crear un nuevo usuario
            $user = User::create([
                'google_id' => $user_google->id,
                'nombres' => $user_google->name,
                'email' => $user_google->email,
                'imagen' => $user_google->avatar,
                'tipo_usuario_id' => $profile_type,
                'email_verified_at' => now(),
            ]);

            // Loguear al nuevo usuario
            Auth::login($user);
            return redirect('/')->with('user', $user->toJson());
        } 
    }

    public function libroReclamos()
    {
        return view('libro.index');
    }
    
}
