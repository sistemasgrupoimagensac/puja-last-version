<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aviso;
use App\Models\User;
use Illuminate\Http\Request;

class AvisoLikeController extends Controller
{
    public function toggleLike(Request $request, $avisoId)
    {
        $request->merge(['aviso_id' => $avisoId]);
        $request->validate([
            'aviso_id' => 'required|integer|min:1',
            'user_id' => 'required|integer',
        ]);

        $aviso = Aviso::findOrFail($avisoId);
        $user = User::findOrFail($request->user_id);

        if ($user->avisosLikeados()->where('aviso_id', $aviso->id)->exists()) {
            $user->avisosLikeados()->detach($aviso->id);
            $liked = false;
        } else {
            $user->avisosLikeados()->attach($aviso->id);
            $liked = true;
        }

        return response()->json([
            'status' => 'success',
            'liked' => $liked,
            'total_likes' => $aviso->likes()->count(),
        ]);
    }
}
