<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
class AppController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // return if the user is not logged in
        if (!$user) {
            return response()->json([
                'message' => 'You are not logged in'
            ], 200);
        }

        return $user;
    }
}
