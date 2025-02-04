<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Aviso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisoLikeController extends Controller
{
    public function toggleLike(Request $request, $avisoId)
    {
        $aviso = Aviso::findOrFail($avisoId);
        $user = Auth::user();

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
            // 'total_likes' => $aviso->likes()->count(),
        ]);
    }
}
