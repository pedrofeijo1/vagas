<?php

namespace App\Http\Controllers;

use App\Municipios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MunicipiosController extends Controller
{
    public function get(Request $request)
    {
//        return response()->json(Municipios::pluck('nome')->toArray());
        return response()->json(Municipios::select('nome', DB::raw('CONCAT(nome, ", ", uf) AS nome'))->pluck('nome'));
    }
}
