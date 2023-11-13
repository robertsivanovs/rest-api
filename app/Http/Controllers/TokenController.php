<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function validateToken(Request $request)
    {
        $token = $request->get('token');
        $user = $request->input('user');

        return response()->json(['valid' => $user]);
    }

    
}
