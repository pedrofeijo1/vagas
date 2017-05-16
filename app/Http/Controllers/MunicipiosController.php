<?php

namespace App\Http\Controllers;

use App\Municipios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MunicipiosController extends Controller
{


    public function get()
    {
        $cidades = Municipios::select('nome', DB::raw('CONCAT(nome, ", ", uf) AS nome'))->pluck('nome');
        return response()->json(array_merge(Municipios::getEstados(), $cidades->toArray()));
    }
}
