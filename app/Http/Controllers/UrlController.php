<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    private static $url;

    public static function getUrl($campo = "", $valor = "")
    {
        self::$url = route('list');
        self::setor(($campo == "s" ? $valor : ""));
        self::localizacao(($campo == "l" ? $valor : ""));
        self::porPagina(($campo == "pp" ? $valor : ""));
        self::pagina(($campo == "page" ? $valor : ""));
        self::ordenar(($campo == "ob" ? $valor : ""));
        self::salarioDe(($campo == "sd" ? $valor : ""));
        self::SalarioAte(($campo == "sa" ? $valor : ""));
        return self::$url;
    }

    private static function setor($valor = "")
    {
        if (empty($valor)) {
            self::$url .= "?s=".app('request')->input('s');
        } else {
            self::$url .= "?s=".$valor;
        }
    }

    private static function localizacao($valor = "")
    {
        if (empty($valor)) {
            self::$url .= "&l=".app('request')->input('l');
        } else {
            self::$url .= "&l=".$valor;
        }
    }

    private static function porPagina($valor = "")
    {
        if (empty($valor)) {
            self::$url .= (app('request')->has('pp') ? "&pp=" . app('request')->input('pp') : "");
        } else {
            self::$url .= "&pp=".$valor;
        }
    }

    private static function pagina($valor = "")
    {
        if (empty($valor)) {
            self::$url .= (app('request')->has('page') ? "&page=" . app('request')->input('page') : "");
        } else {
            self::$url .= "&page=".$valor;
        }
    }

    private static function ordenar($valor = "")
    {
        if (empty($valor)) {
            self::$url .= (app('request')->has('ob') ? "&ob=" . app('request')->input('ob') : "");
        } else {
            self::$url .= "&ob=".$valor;
        }
    }

    private static function salarioDe($valor = "")
    {
        if (empty($valor)) {
            self::$url .= (app('request')->has('sd') ? "&sd=" . app('request')->input('sd') : "");
        } else {
            self::$url .= "&sd=".$valor;
        }
    }

    private static function salarioAte($valor = "")
    {
        if (empty($valor)) {
            self::$url .= (app('request')->has('sa') ? "&sa=" . app('request')->input('sa') : "");
        } else {
            self::$url .= "&sa=".$valor;
        }
    }
}
