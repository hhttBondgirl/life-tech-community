<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoFactorAuthenticationController extends Controller
{
    /**
     * Show the two-factor authentication confirmation form.
     */
    public function show(Request $request)
    {
        return view('auth.two-factor-challenge', [
            'user' => $request->user(),
        ]);
    }
}