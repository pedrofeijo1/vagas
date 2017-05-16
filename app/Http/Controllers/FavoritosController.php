<?php

namespace App\Http\Controllers;

use App\Favoritos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritosController extends Controller
{

    public function toggle(Request $request)
    {
        Favoritos::deleteIfExists(Auth::id(), $request->input('id_vaga'));
        return response()->json([
           'success' => true
        ], 200);
    }
}
