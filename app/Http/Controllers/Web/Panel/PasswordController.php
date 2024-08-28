<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class PasswordController extends Controller
{
    public function __construct()
    {
    }

    public function __invoke(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $active_plan_users = $user->active_plans()->get();
            $tienePlanes = $active_plan_users->isNotEmpty();
        }

        return view('panel.password', compact('tienePlanes', 'user_id'));
    }
}
