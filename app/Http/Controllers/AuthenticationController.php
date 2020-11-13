<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {

        if (Auth::guard('staff')->attempt(['staff_id' => $request->input('userId'), 'password' => $request->input('password')], false)) {
            return redirect()->intended('/pending');
        } else if (Auth::attempt(['student_id' => $request->input('userId'), 'password' => $request->input('password')], false)) {
            return redirect()->intended('/dashboard');
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', true);
    }

    public function logout()
    {
        if (Auth::guard('staff')->check()) {
            Auth::guard('staff')->logout();
        } else if (Auth::check()) {
            Auth::logout();
        }

        return redirect('/');
    }
}
