<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parameter;
use App\Models\Post;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function libroReclamos()
    {
        return 'libro';
    }

    public function indexBlog()
    {
        $posts = Post::where('is_published', true)->latest()->get();

        return response()->json([
            'message' => 'Se envia el blog.',
            'status' => 'success',
            'posts' => $posts,
        ]);

    }

    public function showBlog($slug)
    {
        
        $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return response()->json([
            'message' => 'Se envia el blog.',
            'status' => 'success',
            'post' => $post,
        ]);

    }

    public function landingCount()
    {
        
        $param = Parameter::where('status', 1)->where('name', 'landing')->firstOrFail();
        (int)$param->value++;
        $param->save();

        return response()->json([
            'message' => 'Retorno de cantidad de vistas.',
            'status' => 'success',
            'param' => $param,
        ]);

    }

}
