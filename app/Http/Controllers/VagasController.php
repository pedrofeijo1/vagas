<?php

namespace App\Http\Controllers;

use App\Vagas;
use Illuminate\Http\Request;

class VagasController extends Controller
{
    private $perPage = 10;

    public function index() {
        return view('index');
    }

    public function listar(Request $request)
    {
        $vagas = Vagas::procurar(
            $request->get('s'),
            $request->get('l'),
            ($request->has('ob') ? $request->get('ob') : ""),
            ($request->has('sd') ? $request->get('sd') : ""),
            ($request->has('sa') ? $request->get('sa') : "")
        );
        $vagas = $vagas->paginate(($request->has('pp') ? $request->get('pp') : $this->perPage));
        return view('vagas.list')->with('vagas', $vagas);
    }

    public function search()
    {
        return view('vagas.search');
    }
}
