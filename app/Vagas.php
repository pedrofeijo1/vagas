<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vagas extends Model
{
    protected $table = 'vagas';
    public $timestamps = false;

    public function favoritos()
    {
        return $this->hasMany('App\Favoritos', 'id_vaga', 'id');
    }

    public function usuarios()
    {
        return $this->belongsToMany('App\User', 'favoritos', 'id_vaga', 'id_usuario');
    }

    public static function procurar($funcao, $localizacao, $orderBy, $salarioDe, $salarioAte)
    {
        $vagas = self::where(function($query) use ($funcao, $localizacao, $salarioDe, $salarioAte){
            if (!empty($funcao) && $funcao != "Campo vazio") {
                $query->where(function ($query) use ($funcao) {
                    $query->where('titulo', 'like', "%{$funcao}%");
                    $query->orWhere('descricao', 'like', "%{$funcao}%");
                });
            }
            if (!empty($localizacao)) {
                if (array_search($localizacao, Municipios::getEstados())) {
                    $query->where('estado', '=', array_search($localizacao, Municipios::getEstados()));
                } else {
                    $query->where('localizacao', '=', $localizacao);
                }
            }
            if (!empty($salarioDe)) {
                $query->where('salarioDe', '>=', $salarioDe);
            }
            if (!empty($salarioAte)) {
                $query->where(function ($query) use ($salarioAte) {
                    $query->where('salarioAte', '<=', $salarioAte);
                    $query->where('salarioDe', '<=', $salarioAte);
                });
            }
        });

        if ($orderBy == "su" || empty($orderBy)) {
            return $vagas->orderBy('salarioDe', 'DESC');
        } elseif ($orderBy == "sd") {
            return $vagas->where('salario', '!=', 'A combinar')->orderBy('salarioDe', 'ASC');
        }

        return $vagas;
    }
}
