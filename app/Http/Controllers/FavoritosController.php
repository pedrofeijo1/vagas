<?php

namespace App\Http\Controllers;

use App\Favoritos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function toggle(Request $request)
    {
        Favoritos::deleteIfExists(Auth::id(), $request->input('id_vaga'));
        return response()->json([
           'success' => true
        ], 200);
    }

    public function get()
    {
        return view('vagas.favoritos')->with('vagas', Auth::user()->vagas()->get());
    }
}
