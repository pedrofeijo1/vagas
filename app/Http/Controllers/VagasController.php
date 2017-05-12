<?php

namespace App\Http\Controllers;

use App\Vagas;
use Illuminate\Http\Request;

class VagasController extends Controller
{
    public function index() {
        return view('index');
    }

    public function proucurarVagas(Request $request)
    {
        $vagas = Vagas::procurar($request->get('funcao'), $request->get('localizacao'));
        dd($vagas);
    }
}
