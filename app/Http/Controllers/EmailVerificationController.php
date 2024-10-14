<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function notice ()
    {
        return view('auth.verify-email');
    }
    
    public function verify (EmailVerificationRequest $request)
    {

        dd($request);
        $request->fulfill();
        return redirect('/');
    }

    public function send (Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
